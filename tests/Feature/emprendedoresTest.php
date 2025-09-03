<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use Database\Factories;
use App\Models\Emprendedor;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Horario;
use App\Models\Direccion;
use App\Models\Redes;
use Mockery;
use App\Models\Imagenes;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class emprendedoresTest extends TestCase
{
    use RefreshDatabase;

    private function crearUsuario($permission){
        $role1=Role::create(['name' => 'admin']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        if($permission != null){
            Permission::create(['name' => $permission]);
            $role1->givePermissionTo($permission);
        }
        return $admin;
    }

    public function test_get_emprendedor_detalle(){
        $categoria = Categoria::factory()->create();
        $emprendedor = Emprendedor::factory()->create();
        $response = $this->get("/emprendedor/{$emprendedor->id}");
        $response->assertStatus(200);
        $response->assertViewIs('emprendedor.templateEmprendedor');
    }


    public function test_get_non_existing_emprendedor_details(){
        $response = $this->get('/emprendedor/190');
        // 1. Asegura que hubo un redirect (302)
        $response->assertStatus(302);

        // 2. Asegura que redirige a la ruta esperada
        $response->assertRedirect('/emprendedores');

        /* 3. (Opcional) Sigue la redirección y verifica el mensaje de error
        $followed = $this->followingRedirects()->get('/emprendedor/190');
        $followed->assertSee('Ha sucedido un error'); // o lo que muestre en la vista
        */
    }


    public function test_get_form_nuevo_emprendimiento(){
        $response = $this->get("/emprendedores/nuevoEmprendimiento");
        $response->assertStatus(302);
        $response->assertRedirect('/showlogin');
    }


    public function test_get_form_nuevo_emprendimiento_logueado_incorrecto(){
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get("/emprendedores/nuevoEmprendimiento");
        //Deberia pasar test si los datos que se crean en User es con faker porque son randoms
        $response->assertStatus(403);
    }


    public function test_get_form_nuevo_emprendimiento_logueado_admin(){
        $admin = $this->crearUsuario('crear emprendimiento');
        $response = $this->actingAs($admin)->get("/emprendedores/nuevoEmprendimiento");
        //Deberia pasar test si los datos que se crean en User es con faker porque son randoms
        $response->assertStatus(200);
        $response->assertViewIs('administradores.emprendedores.formNuevoEmprendimiento');
    }


    public function test_crear_emprendimiento_exitoso(){
        $admin = $this->crearUsuario('crear emprendimiento');
        $categoria = Categoria::factory()->create();
        // Simular imagen
        Storage::fake('public');
        $imagenFake = UploadedFile::fake()->image('foto.jpg');

        // Mockear Cloudinary
        //técnica que se usa en programación, especialmente en tests, 
        // para crear versiones simuladas o falsas de objetos, funciones o servicios.
        Cloudinary::shouldReceive('upload')
            ->andReturn(Mockery::mock([
                'getSecurePath' => 'https://fake.cloudinary.com/emprendedor.jpg',
                'getPublicId' => 'emprendedor_123',
        ]));
        
        //Simular request POST con datos válidos
        $response = $this->actingAs($admin)->post('/crearEmprendimiento', [
            'nombre' => 'Mi emprendimiento',
            'descripcion' => 'Descripción del emprendimiento',
            'categoria' => $categoria->id,
            // redes
            'instagram' => 'https://instagram.com/emprendedor',
            'facebook' => 'https://facebook.com/emprendedor',
            'whatsapp' => '123456789',
            // dirección
            'ciudad' => 'Ciudad X',
            'localidad' => 'Localidad Y',
            'calle' => 'Calle Z',
            'altura' => '123',
            // horarios
            'horarios' => [
                'lunes' => [
                    'hora_de_apertura' => '08:00',
                    'hora_de_cierre' => '18:00',
                    'participa_feria' => true,
                    'cerrado' => false,
                ]
            ],
            // imagenes
            'imagenes' => [$imagenFake],
        ]);

        $response->assertRedirect('/emprendedores');
        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $sessionData = session('success');
        $this->assertEquals('¡Creado!', $sessionData['titulo']);
        $this->assertEquals('Emprendimiento creado con éxito.', $sessionData['detalle']);
        $this->assertDatabaseHas('emprendedor', [
            'nombre' => 'Mi emprendimiento',
            'descripcion' => 'Descripción del emprendimiento',
        ]);
        $this->assertDatabaseHas('horario', [
            'dia' => 'lunes',
            'hora_apertura' => '08:00',
            'hora_cierre' => '18:00',
        ]);
    }


    public function test_eliminar_emprendimiento(){
        $admin = $this->crearUsuario('eliminar emprendimiento');
        
        $categoria = Categoria::factory()->create();
        $redes = Redes::factory()->create();
        $direccion = Direccion::factory()->create();
        $emprendimiento = Emprendedor::factory()->create([
            'id' => 1,
            'categoria_id' => $categoria->id,
            'redes_id' => $redes->id,
            'direccion_id' => $direccion->id,
        ]);
        $imagenes = Imagenes::factory()->count(2)->create([
            'emprendedor_id' => 1,
            'public_id' => 'fake_public_id',
        ]);
        $horarios = Horario::factory()->count(2)->create([
            'emprendedor_id' => 1,
        ]);

        Cloudinary::shouldReceive('uploadApi->destroy')->andReturnTrue();

        // Ejecutar la acción
        $response = $this->actingAs($admin)->delete("/emprendedor/{$emprendimiento->id}");

        $response->assertStatus(302);
        $response->assertRedirect('/emprendedores');
        $response->assertSessionHas('success');
        $sessionData = session('success');
        $this->assertEquals('¡Eliminado!', $sessionData['titulo']);
        $this->assertEquals('Emprendimiento eliminado con éxito.', $sessionData['detalle']);
    

        // Confirmar que se eliminaron de la base de datos
        $this->assertDatabaseMissing('emprendedor', ['id' => $emprendimiento->id]);
        $this->assertDatabaseMissing('direccion', ['id' => $direccion->id]);
        $this->assertDatabaseMissing('redes', ['id' => $redes->id]);
        foreach ($imagenes as $img) {
            $this->assertDatabaseMissing('imagenes', ['id' => $img->id]);
        }
        foreach ($horarios as $horario) {
            $this->assertDatabaseMissing('horario', ['id' => $horario->id]);
        }
    }


    public function test_eliminar_emprendimiento_inexistente(){
        $this->refreshDatabase();
        $admin = $this->crearUsuario("eliminar emprendimiento");

        $response = $this->actingAs($admin)->delete("/emprendedor/999");

        $response->assertRedirect('/emprendedores');
        $response->assertSessionHas('error');
        $sessionData = session('error');
        $this->assertEquals('¡Error!', $sessionData['titulo']);
        $this->assertEquals('No se ha encontrado el emprendimiento que se desea eliminar, intentelo nuevamente.', $sessionData['detalle']);
    }


    public function test_eliminar_emprendimiento_sin_autorizacion(){
        $user = $this->crearUsuario(null);
        $response = $this->actingAs($user)->delete("/emprendedor/999");
        $response->assertStatus(403);
    }


    public function test_editarImagenesEmprendimiento_validacion_fallida(){
        $admin = $this->crearUsuario('editar emprendimiento');
        $this->actingAs($admin);

        $emprendedor = Emprendedor::factory()->create();
        $response = $this->json('POST', "/emprendedores/editarImgs/{$emprendedor->id}", [
            'imagenes' => ['no-es-una-imagen'],
        ]);
        $response->assertStatus(400);
        $response->assertJsonFragment(['status' => 'error']);
    }


    public function test_editarImagenesEmprendimiento_elimina_imagenes_y_sube_nuevas(){
        $admin = $this->crearUsuario('editar emprendimiento');
        $this->actingAs($admin);

        $emprendedor = Emprendedor::factory()->create();
        $imagenesExistentes = Imagenes::factory()->count(2)->create(['emprendedor_id' => $emprendedor->id]);
        // Simulamos conservar sólo la primera imagen
        $imagenesConservar = json_encode([
            ['id' => $imagenesExistentes[0]->id]
        ]);

        $mockUploadResponse = \Mockery::mock();
        $mockUploadResponse->shouldReceive('getSecurePath')->andReturn('http://fakeurl.com/image.jpg');
        $mockUploadResponse->shouldReceive('getPublicId')->andReturn('public_id_fake');

        Cloudinary::shouldReceive('uploadApi->destroy')->once()->andReturn(true);
        Cloudinary::shouldReceive('upload')->once()->andReturn($mockUploadResponse);

        // Simular archivo subido
        $file = UploadedFile::fake()->image('test.jpg');

        // Ejecutar la request
        $response = $this->postJson("/emprendedores/editarImgs/{$emprendedor->id}", [
            'imagenes' => [$file],
            'imagenes_conservar' => $imagenesConservar,
        ]);
        $response->assertStatus(200);
    }

    public function test_acceder_formulario_editar_sin_logueo(){
        $response = $this->get("/emprendedores/formEditarEmprendimiento/1");
        $response->assertStatus(302);
        $response->assertRedirect('/showlogin');
    }

    public function test_acceder_formulario_editar_con_logueo_sin_autorizacion(){
        $admin = $this->crearUsuario(null);
        $this->actingAs($admin);
        $response = $this->get("/emprendedores/formEditarEmprendimiento/1");
        $response->assertStatus(403);
    }

    public function test_acceder_formulario_editar_con_logueo_con_autorizacion(){
        $admin = $this->crearUsuario('editar emprendimiento');
        $this->actingAs($admin);
        $emprendedor = Emprendedor::factory()->create();
        $response = $this->get("/emprendedores/formEditarEmprendimiento/{$emprendedor->id}");
        $response->assertStatus(200);
        $response->assertViewIs('administradores.emprendedores.formEditarEmprendimiento');
    }

    public function test_acceder_formulario_emprendimiento_inexistente(){
        $admin = $this->crearUsuario('editar emprendimiento');
        $this->actingAs($admin);
        $response = $this->get("/emprendedores/formEditarEmprendimiento/12333");
        $response->assertStatus(302);
        $response->assertRedirect('/emprendedores');
        $response->assertSessionHas('error');
        $sessionData = session('error');
        $this->assertEquals('¡Error!', $sessionData['titulo']);
        $this->assertEquals('No se ha logrado encontrar el eprendimiento, inténtelo nuevamente.', $sessionData['detalle']);
    }


    public function test_acceder_formulario_con_otro_valor_diferente_a_un_numero(){
        $admin = $this->crearUsuario('editar emprendimiento');
        $this->actingAs($admin);
        $response = $this->get("/emprendedores/formEditarEmprendimiento/Pastel");
        $response->assertStatus(302);
        $response->assertRedirect('/emprendedores');
        $response->assertSessionHas('error');
        $sessionData = session('error');
        $this->assertEquals('¡Error!', $sessionData['titulo']);
        $this->assertEquals('Debe ingresar un número mayor a cero para buscar y editar el emprendimiento.', $sessionData['detalle']);
    }


    public function test_acceder_formulario_con_numero_negativo(){
        $admin = $this->crearUsuario('editar emprendimiento');
        $this->actingAs($admin);
        $response = $this->get("/emprendedores/formEditarEmprendimiento/-4");
        $response->assertStatus(302);
        $response->assertRedirect('/emprendedores');
        $response->assertSessionHas('error');
        $sessionData = session('error');
        $this->assertEquals('¡Error!', $sessionData['titulo']);
        $this->assertEquals('Debe ingresar un número mayor a cero para buscar y editar el emprendimiento.', $sessionData['detalle']);
    
    }
    
}

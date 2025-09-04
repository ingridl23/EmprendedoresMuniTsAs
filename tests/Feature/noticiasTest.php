<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Noticias;
use Mockery;
use App\Models\Imagenes;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class noticiasTest extends TestCase
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

    public function test_mostrar_noticias(){
        $response = $this->get("/noticias");
        $response->assertViewIs('layouts.noticias');
        $response->assertStatus(200);
        $response->assertViewHas('noticias'); //Verifica que la vista recibió una variable llamada $noticias
        $noticias = $response->viewData('noticias');
        $this->assertInstanceOf(\Illuminate\Pagination\LengthAwarePaginator::class, $noticias);
    }

    public function test_mostrar_noticia_individual(){
        $noticia = Noticias::factory()->create();
        $response = $this->get("/noticias/{$noticia->id}");
        $response->assertViewIs('layouts.noticia');
        $response->assertStatus(200);
        $response->assertViewHas('noticia');
    }


    public function test_mostrar_noticia_individual_inexistente(){
        $response = $this->get("/noticias/2333");
        $response->assertRedirect('/noticias');
        $response->assertStatus(302);
        $response->assertSessionHas('error');
        $sessionData = session('error');
        $this->assertEquals('¡Error!', $sessionData['titulo']);
        $this->assertEquals('No se ha encontrado una noticia que coincida, intentelo nuevamente.', $sessionData['detalle']);
    }

    public function test_mostrar_noticia_individual_id_incorrecto(){
        $response = $this->get("/noticias/hhh");
        $response->assertRedirect('/noticias');
        $response->assertStatus(302);
        $response->assertSessionHas('error');
        $sessionData = session('error');
        $this->assertEquals('¡Error!', $sessionData['titulo']);
        $this->assertEquals('Debe ingresar un número mayor a cero para buscar la noticia.', $sessionData['detalle']);
    }

    /**---------------------------- CREAR NOTICIA-------------------------- */

    public function test_acceder_formulario_crear_noticia_sin_loguear(){
        $response = $this->get("/noticias/nuevaNoticia");
        $response->assertStatus(302);
        $response->assertRedirect('/showlogin');
    }


    public function test_acceder_formulario_crear_noticia_logueado_incorrecto(){
        $user = $this->crearUsuario(null);
        $this->actingAs($user);
        $response = $this->get("/noticias/nuevaNoticia");
        $response->assertStatus(403);
    }


    public function test_acceder_formulario_crear_noticia_logueado(){
        $user = $this->crearUsuario('crear noticia');
        $this->actingAs($user);
        $response = $this->get("/noticias/nuevaNoticia");
        $response->assertStatus(200);
        $response->assertViewIs('administradores.noticias.formCrearNoticia');
    }



    public function test_crear_noticia_exitosa(){
        $admin = $this->crearUsuario('crear noticia');

        Storage::fake('public');
        $imagenFake = UploadedFile::fake()->image('foto.jpg');

        // Mockear Cloudinary
        //técnica que se usa en programación, especialmente en tests, 
        // para crear versiones simuladas o falsas de objetos, funciones o servicios.
        Cloudinary::shouldReceive('upload')
            ->andReturn(Mockery::mock([
                'getSecurePath' => 'https://fake.cloudinary.com/noticia.jpg',
                'getPublicId' => 'noticia_123',
        ]));
        
        //Simular request POST con datos válidos
        $response = $this->actingAs($admin)->post('/noticias/cargarNuevaNoticia', [
            'titulo' => 'Mi noticia',
            'descripcion' => 'Descripción de la noticia',
            'categoria' => 'Evento',
            'imagen' => $imagenFake,
            'imagen_public_id' => "123456"
        ]);

        $response->assertRedirect('/noticias');
        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $sessionData = session('success');
        $this->assertEquals('¡Creado!', $sessionData['titulo']);
        $this->assertEquals('Noticia creada con éxito.', $sessionData['detalle']);
    

        $this->assertDatabaseHas('noticias', [
            'titulo' => 'Mi noticia',
            'descripcion' => 'Descripción de la noticia',
        ]);
    }


    /**------------------------------ EDITAR ----------------------------- */
    public function test_acceder_formulario_editar_noticia_sin_loguear(){
        $response = $this->get("/noticias/formEditarNoticia/1");
        $response->assertStatus(302);
        $response->assertRedirect('/showlogin');
    }


    public function test_acceder_formulario_editar_noticia_logueado_incorrecto(){
        $user = $this->crearUsuario(null);
        $this->actingAs($user);
        $response = $this->get("/noticias/formEditarNoticia/1");
        $response->assertStatus(403);
    }


    public function test_acceder_formulario_editar_noticia_logueado(){
        $user = $this->crearUsuario('editar noticia');
        $this->actingAs($user);
        $noticia = Noticias::factory()->create();
        $response = $this->get("/noticias/formEditarNoticia/{$noticia->id}");
        $response->assertStatus(200);
        $response->assertViewIs('administradores.noticias.formEditarNoticia');
    }


    public function test_acceder_formulario_editar_noticia_logueado_error_indice_numero_negativo(){
        $user = $this->crearUsuario('editar noticia');
        $this->actingAs($user);
        $response = $this->get("/noticias/formEditarNoticia/-40");
        $response->assertStatus(302);
        $response->assertRedirect('/noticias');
        $response->assertSessionHas('error');
        $sessionData = session('error');
        $this->assertEquals('¡Error!', $sessionData['titulo']);
        $this->assertEquals('Debe ingresar un número mayor a cero para buscar y editar una noticia.', $sessionData['detalle']);
    }


    public function test_acceder_formulario_editar_noticia_logueado_error_indice_texto(){
        $user = $this->crearUsuario('editar noticia');
        $this->actingAs($user);
        $response = $this->get("/noticias/formEditarNoticia/sss");
        $response->assertStatus(302);
        $response->assertRedirect('/noticias');
        $response->assertSessionHas('error');
        $sessionData = session('error');
        $this->assertEquals('¡Error!', $sessionData['titulo']);
        $this->assertEquals('Debe ingresar un número mayor a cero para buscar y editar una noticia.', $sessionData['detalle']);
    }



    public function test_editar_imagen_existente_noticia(){
        $admin = $this->crearUsuario('editar noticia');
        $this->actingAs($admin);

        $noticia = Noticias::factory()->create([
            'imagen' => 'https://cloudinary.com/old.jpg',
            'imagen_public_id' => 'old_public_id',
        ]);

         // Falsificar almacenamiento
        Storage::fake('public');
        $imagenFake = UploadedFile::fake()->image('nueva.jpg');

        // Mockear Cloudinary destroy y upload
        Cloudinary::shouldReceive('uploadApi->destroy')
            ->once()
            ->with('old_public_id')
            ->andReturn(['result' => 'ok']);

        Cloudinary::shouldReceive('upload')
            ->once()
            ->andReturn(Mockery::mock([
                'getSecurePath' => 'https://cloudinary.com/nueva.jpg',
                'getPublicId' => 'new_public_id',
            ]));

        // Ejecutar el POST al endpoint de edición
        $response = $this->actingAs($admin)->postJson("/noticias/editarImgs/{$noticia->id}", [
            'public_id' => 'new_public_id',
            'imagen' => $imagenFake,
        ]);

        // Verificar respuesta JSON
        $response->assertStatus(200);
        $response->assertJson([
            'OK' => 'La imagen es la misma', // Este mensaje se devuelve en ambos casos, podrías ajustarlo
        ]);

        // Verificar que se haya actualizado en la base
        $this->assertDatabaseHas('noticias', [
            'id' => $noticia->id,
            'imagen' => 'https://cloudinary.com/nueva.jpg',
            'imagen_public_id' => 'new_public_id',
        ]);
    }



    public function test_editar_imagen_noticia_con_la_misma_imagen(){
        $admin = $this->crearUsuario('editar noticia');
        $noticia = Noticias::factory()->create([
            'imagen_public_id' => 'igual_id',
        ]);
        $imagenFake = UploadedFile::fake()->image('foto.jpg');
        $response = $this->actingAs($admin)->postJson("/noticias/editarImgs/{$noticia->id}", [
            'imagen' => $imagenFake,
            'public_id' => 'igual_id',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'OK' => 'La imagen es la misma',
        ]);
    }



    public function test_editar_imagen_noticia_con_imagen_invalida(){
        $admin = $this->crearUsuario('editar noticia');
        $noticia = Noticias::factory()->create();

        $archivoInvalido = UploadedFile::fake()->create('documento.pdf', 100, 'application/pdf');

        $response = $this->actingAs($admin)->postJson("/noticias/editarImgs/{$noticia->id}", [
            'imagen' => $archivoInvalido,
            'public_id' => $noticia->imagen_public_id,
        ]);

        $response->assertStatus(400);
        $response->assertJson([
            'message' => [
                'titulo' => '¡Error!',
                'detalle' => 'Ha sucedido un error en la validación de la imagen',
            ],
            'status' => 'error',
        ]);
    }

    /**----------------- ELIMINAR --------------------------- */

    public function test_eliminar_noticia(){
        $admin = $this->crearUsuario('eliminar noticia');
        
        $noticia = Noticias::factory()->create([
            'id' => 1
        ]);

        Cloudinary::shouldReceive('uploadApi->destroy')->andReturnTrue();

        // Ejecutar la acción
        $response = $this->actingAs($admin)->delete("/noticias/{$noticia->id}");

        $response->assertStatus(302);
        $response->assertRedirect('/noticias');
        $response->assertSessionHas('success');
        $sessionData = session('success');
        $this->assertEquals('¡Eliminado!', $sessionData['titulo']);
        $this->assertEquals('La noticia ha sido eliminada con éxito.', $sessionData['detalle']);

        // Confirmar que se eliminaron de la base de datos
        $this->assertDatabaseMissing('noticias', ['id' => $noticia->id]);
    }


    public function test_eliminar_noticia_inexistente(){
        $admin = $this->crearUsuario('eliminar noticia');
        $response = $this->actingAs($admin)->delete("/noticias/231");
        $response->assertStatus(302);
        $response->assertRedirect('/noticias');
        $response->assertSessionHas('error');
        $sessionData = session('error');
        $this->assertEquals('¡Error!', $sessionData['titulo']);
        $this->assertEquals('No se ha encontrado la noticia que se desea eliminar.', $sessionData['detalle']);
    }


    public function test_eliminar_noticia_sin_autorizacion(){
        $user = $this->crearUsuario(null);
        $response = $this->actingAs($user)->delete("/noticias/12");
        $response->assertStatus(403);
    }

    /**------------------ FILTROS ------------------------- */

    public function test_filtro_por_titulo(){
        Noticias::factory()->create([
            'titulo' => 'Nueva apertura del parque industrial',
        ]);
        $response = $this->getJson('/noticias/buscadorTitulo?busqueda=parque');
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment([
            'titulo' => 'Nueva apertura del parque industrial',
        ]);
    }

    public function test_filtro_por_categoria(){
        Noticias::factory()->create([
            'categoria' => 'Evento',
        ]);
        $response = $this->getJson('/noticias/buscadorCategoria?busqueda=Evento');
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $response->assertJsonFragment([
            'categoria' => 'Evento',
        ]);
    }

    public function test_filtro_por_fecha(){
        $fecha = '2025-09-04';
        Noticias::factory()->create([
            'created_at' => \Carbon\Carbon::parse($fecha),
        ]);
        $response = $this->getJson("/noticias/buscadorFecha?busqueda={$fecha}");
        $response->assertStatus(200);
        $response->assertJsonCount(1);
        $jsonData = $response->json();
        //Obtiene la fecha de la noticia y la convierte a un formato: YYYY-MM-DD 
        //para compararla con la fecha que se estaba buscando
        $createdAt = \Carbon\Carbon::parse($jsonData[0]['created_at'])->toDateString();
        $this->assertEquals($fecha, $createdAt);
    }

}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Noticias;

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
        $response->assertSessionHas('error', [
            'titulo' => '¡Error!',
            'detalle' => 'Debe ingresar un número mayor a cero para buscar y editar una noticia.',
        ]);
    }


    public function test_acceder_formulario_editar_noticia_logueado_error_indice_texto(){
        $user = $this->crearUsuario('editar noticia');
        $this->actingAs($user);
        $response = $this->get("/noticias/formEditarNoticia/sss");
        $response->assertStatus(302);
        $response->assertRedirect('/noticias');
        $response->assertSessionHas('error', [
            'titulo' => '¡Error!',
            'detalle' => 'Debe ingresar un número mayor a cero para buscar y editar una noticia.',
        ]);
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;

class loginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_exitoso(){
        // Crear rol "admin" si no existe
        Role::firstOrCreate(['name' => 'admin']);
        // Crear usuario
        $user = User::factory()->create([
            'email' => 'adminempleo@tresarroyos.gov.ar',
            'password' => bcrypt('ClaveDePrueba1'), // contraseña inventada, solo para el test
        ]);

        $response = $this->post('/login', [
            'email' => 'adminempleo@tresarroyos.gov.ar',
            'password' => 'ClaveDePrueba1', // Lo que el usuario ingresa
        ]);

        $response->assertRedirect();
        $this->assertAuthenticatedAs($user); // Verifica login
        $response->assertStatus(302);
    }



    public function test_login_fallido(){
        // Crear rol "admin" si no existe
        Role::firstOrCreate(['name' => 'admin']);
        // Crear usuario
        $user = User::factory()->create([
            'email' => 'adminempleo@tresarroyos.gov.ar',
            'password' => bcrypt('ClaveDePrueba1'), // contraseña inventada, solo para el test
        ]);

        $response = $this->post('/login', [
            'email' => 'adminempleo@tresarroyos.gov.ar',
            'password' => 'clavedeprueba1', // Lo que el usuario ingresa (mal: minúsculas)
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['error' => 'Credenciales incorrectas Login.']);
        $this->assertGuest(); // Asegura que NO está autenticado
        $response->assertStatus(302);
    }



    public function test_login_rechazado_por_oculto(){
        $response = $this->post('/login', [
            'email' => 'admin@correo.com',
            'password' => 'clave1234',
            'oculto' => 'bot_dato', // Simula bot
        ]);
        $response->assertRedirect();
        //$response->assertSessionHas('error', 'formulario rechazado posible bot detectado');
        $this->assertGuest(); // Asegura que no se logueó
    }


    
    public function test_logout(){
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->post('/logout');
        $response->assertRedirect('/showlogin');
        $this->assertGuest();
    }
}

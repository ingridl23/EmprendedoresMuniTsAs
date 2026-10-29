<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginThrottleTest extends TestCase
{
    use RefreshDatabase;

    private function crearUsuario(): User
    {
        /** @var User $user */
        $user = User::factory()->create(['password' => Hash::make('ClaveBuena1')]);
        return $user;
    }

    private function intentarLogin(User $user, string $password)
    {
        return $this->post('/login', ['email' => $user->email, 'password' => $password]);
    }

    public function test_despues_de_5_fallos_bloquea_aunque_la_clave_sea_correcta()
    {
        $user = $this->crearUsuario();

        for ($i = 0; $i < 5; $i++) {
            $this->intentarLogin($user, 'ClaveMala1');
        }
        $response = $this->intentarLogin($user, 'ClaveBuena1');

        $response->assertSessionHasErrors('email');
        $this->assertStringContainsString('Demasiados intentos', session('errors')->first('email'));
        $this->assertGuest();
    }

    public function test_4_fallos_no_bloquean()
    {
        $user = $this->crearUsuario();

        for ($i = 0; $i < 4; $i++) {
            $this->intentarLogin($user, 'ClaveMala1');
        }
        $this->intentarLogin($user, 'ClaveBuena1');

        $this->assertAuthenticatedAs($user);
    }

    public function test_el_bloqueo_se_levanta_pasado_el_minuto()
    {
        $user = $this->crearUsuario();

        for ($i = 0; $i < 5; $i++) {
            $this->intentarLogin($user, 'ClaveMala1');
        }
        $this->travel(61)->seconds();
        $this->intentarLogin($user, 'ClaveBuena1');

        $this->assertAuthenticatedAs($user);
    }

    public function test_un_login_correcto_reinicia_el_contador()
    {
        $user = $this->crearUsuario();

        for ($i = 0; $i < 4; $i++) {
            $this->intentarLogin($user, 'ClaveMala1');
        }
        $this->intentarLogin($user, 'ClaveBuena1');
        $this->post('/logout');

        // Si el contador no se hubiera reiniciado, este quinto fallo bloquearía el login siguiente
        $this->intentarLogin($user, 'ClaveMala1');
        $this->intentarLogin($user, 'ClaveBuena1');

        $this->assertAuthenticatedAs($user);
    }
}

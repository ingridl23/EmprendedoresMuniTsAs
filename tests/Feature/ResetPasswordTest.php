<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    private function crearUsuario(string $password = 'ClaveVieja1'): User
    {
        /** @var User $user */
        $user = User::factory()->create(['password' => Hash::make($password)]);
        return $user;
    }

    public function test_formulario_para_pedir_el_mail_se_muestra()
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
        $response->assertSee(route('password.email'), false);
    }

    public function test_formulario_de_reset_con_token_se_muestra()
    {
        $user = $this->crearUsuario();
        $token = Password::broker()->createToken($user);

        $response = $this->get("/password/reset/{$token}?email={$user->email}");

        $response->assertStatus(200);
        $response->assertSee($token, false); // el token viaja en el input oculto
    }

    public function test_reset_cambia_la_contrasena()
    {
        $user = $this->crearUsuario();
        $token = Password::broker()->createToken($user);

        $response = $this->post('/password/reset', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'ClaveNueva1',
            'password_confirmation' => 'ClaveNueva1',
        ]);

        $response->assertRedirect('/');
        $this->assertTrue(Hash::check('ClaveNueva1', $user->fresh()->password));
    }

    public function test_reset_con_token_invalido_no_cambia_la_contrasena()
    {
        $user = $this->crearUsuario();

        $response = $this->post('/password/reset', [
            'token' => 'token-invalido',
            'email' => $user->email,
            'password' => 'ClaveNueva1',
            'password_confirmation' => 'ClaveNueva1',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertTrue(Hash::check('ClaveVieja1', $user->fresh()->password));
    }

    public function test_ruta_vieja_sin_token_ya_no_existe()
    {
        $this->get('/passwords/reset')->assertStatus(404);
    }
}

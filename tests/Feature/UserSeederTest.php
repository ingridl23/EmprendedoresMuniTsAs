<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Output\BufferedOutput;
use Tests\TestCase;

/**
 * Punto 2.8: el seeder de usuarios no tiene contraseñas en el código.
 */
class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    private const EMAILS = ['oficina.empleo@tresarroyos.gov.ar', 'adminempleo@tresarroyos.gov.ar'];

    private function conVariables(?string $oficina, ?string $empleo): void
    {
        foreach (['ADMIN_OFICINA_PASSWORD' => $oficina, 'ADMIN_EMPLEO_PASSWORD' => $empleo] as $nombre => $valor) {
            if ($valor === null) {
                putenv($nombre);
                unset($_ENV[$nombre], $_SERVER[$nombre]);
            } else {
                putenv("{$nombre}={$valor}");
                $_ENV[$nombre] = $_SERVER[$nombre] = $valor;
            }
        }
    }

    protected function tearDown(): void
    {
        $this->conVariables(null, null);
        parent::tearDown();
    }

    public function test_usa_las_contrasenas_del_env()
    {
        $this->conVariables('ClaveOficina1', 'ClaveEmpleo1');

        $this->seed(UserSeeder::class);

        $this->assertTrue(Hash::check('ClaveOficina1', User::where('email', self::EMAILS[0])->firstOrFail()->password));
        $this->assertTrue(Hash::check('ClaveEmpleo1', User::where('email', self::EMAILS[1])->firstOrFail()->password));
    }

    public function test_sin_variables_genera_contrasena_aleatoria_que_sirve_para_el_login()
    {
        $this->conVariables(null, null);

        $salida = new BufferedOutput();
        $codigo = Artisan::call('db:seed', ['--class' => UserSeeder::class], $salida);

        $this->assertSame(0, $codigo);
        $texto = $salida->fetch();
        $this->assertStringContainsString('ADMIN_OFICINA_PASSWORD no está en el .env', $texto);
        $this->assertStringContainsString('ADMIN_EMPLEO_PASSWORD no está en el .env', $texto);

        foreach (self::EMAILS as $email) {
            $user = User::where('email', $email)->firstOrFail();
            $this->assertTrue($user->hasRole('admin'));

            // La contraseña mostrada es la guardada y cumple el largo que exige el login (8 a 14)
            $this->assertMatchesRegularExpression('/' . preg_quote($email, '/') . ': (\S+)/', $texto);
            preg_match('/' . preg_quote($email, '/') . ': (\S+)/', $texto, $m);
            $this->assertTrue(Hash::check($m[1], $user->password));
            $this->assertGreaterThanOrEqual(8, strlen($m[1]));
            $this->assertLessThanOrEqual(14, strlen($m[1]));
        }
    }

    public function test_correrlo_dos_veces_no_duplica_ni_cambia_la_contrasena()
    {
        $this->conVariables('ClaveOficina1', 'ClaveEmpleo1');
        $this->seed(UserSeeder::class);

        $this->conVariables('OtraClave123', 'OtraClave456');
        $this->seed(UserSeeder::class);

        $this->assertSame(1, User::where('email', self::EMAILS[0])->count());
        $this->assertTrue(Hash::check('ClaveOficina1', User::where('email', self::EMAILS[0])->firstOrFail()->password));
    }
}

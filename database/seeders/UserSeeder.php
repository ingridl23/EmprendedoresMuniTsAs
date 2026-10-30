<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Cuentas admin que crea el seeder: email => [nombre, variable del .env con la contraseña].
     */
    private const ADMINS = [
        'oficina.empleo@tresarroyos.gov.ar' => ['oficinaEmpleo', 'ADMIN_OFICINA_PASSWORD'],
        'adminempleo@tresarroyos.gov.ar' => ['adminEmpleo', 'ADMIN_EMPLEO_PASSWORD'],
    ];

    /**
     * Run the database seeds.
     *
     * Las contraseñas no van en el código: se leen del .env. Si la variable no está, se genera
     * una aleatoria de 12 caracteres (el login acepta de 8 a 14) y se muestra una sola vez en consola.
     * Si el usuario ya existe no se toca su contraseña.
     *
     * @return void
     */
    public function run()
    {
        // crea el rol admin si no existe
        Role::firstOrCreate(['name' => 'admin']);

        foreach (self::ADMINS as $email => [$nombre, $variable]) {
            $user = User::where('email', $email)->first();
            if ($user === null) {
                $password = env($variable);
                if (!$password) {
                    $password = Str::random(12);
                    $this->command->warn("{$variable} no está en el .env: contraseña generada para {$email}: {$password}");
                }
                $user = User::create([
                    'name' => $nombre,
                    'email' => $email,
                    'password' => Hash::make($password),
                ]);
            }
            $user->assignRole('admin');
        }
    }
}

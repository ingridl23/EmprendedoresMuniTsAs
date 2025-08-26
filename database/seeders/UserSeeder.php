<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use seeders\RoleAndPermissionsSeeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // crea el rol admin si no existe
        Role::firstOrCreate(['name' => 'admin']);

        $user = User::firstOrCreate([
            'name' => 'oficinaEmpleo',
            'email' => 'oficina.empleo@tresarroyos.gov.ar',
            'password' => Hash::make('#w.J+p2yS8_4'),
        ]);
        $user->assignRole('admin');


        $user = User::firstOrCreate([
            'name' => 'adminEmpleo',
            'email' => 'adminempleo@tresarroyos.gov.ar',
            'password' => Hash::make('AdminE016'),
        ]);
        $user->assignRole('admin');
    }
}

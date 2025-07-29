<?php

namespace Database\Seeders;

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
        $user = User::create([
            'name' => 'oficinaEmpleo',
            'email' => 'oficina.empleo@tresarroyos.gov.ar',
            'password' => Hash::make('#w.J+p2yS8_4'),
        ]);
        $user->assignRole('admin');


        $user = User::create([
            'name' => 'adminEmpleo',
            'email' => 'adminempleo@tresarroyos.gov.ar',
            'password' => Hash::make('AdminE016'),
        ]);
        $user->assignRole('admin');
    }
}

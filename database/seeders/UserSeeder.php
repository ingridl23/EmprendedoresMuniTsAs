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
            'name' => 'cultura',
            'email' => 'cultura@gmail.com',
            'password' => Hash::make('2025Muni'),
        ]);
        $user->assignRole('admin');
    }
}

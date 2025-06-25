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
        $user = User::where('email', 'valen@gmail.com')->first();
        if(empty($user)){
            $user=User::create([
            'name' => 'Valentina',
            'email' => 'valen@gmail.com',
            'password' => Hash::make('valentina1212'),
            ]);
        }
        $user->assignRole('admin');
        
    }
}

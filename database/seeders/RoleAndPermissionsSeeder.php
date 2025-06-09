<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate([
            'name'=>'admin',
        ]);
        $user = Role::firstOrCreate([
            'name'=>'user',
        ]);

        Permission::firstOrCreate([
            'name'=>'crear emprendimiento',
        ]);
        Permission::firstOrCreate([
            'name'=>'editar emprendimiento',
        ]);
        Permission::firstOrCreate([
            'name'=>'eliminar emprendimiento',
        ]);

        $admin->givePermissionTo('crear emprendimiento');
        $admin->givePermissionTo('editar emprendimiento');
        $admin->givePermissionTo('eliminar emprendimiento');
        
    }   
}

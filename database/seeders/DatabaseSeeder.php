<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleAndPermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call([
            //RedesSeeder::class,
            EmprendedorSeeder::class,

        ]);
        $this->call([
            ImagenSeeder::class,
        ]);
        $this->call(ImagenSeeder::class);
        $this->call(noticiaSeeder::class);
        $this->call(RedesSeeder::class);
        $this->call([
            EmpleosSeeder::class,
        ]);
    }
}

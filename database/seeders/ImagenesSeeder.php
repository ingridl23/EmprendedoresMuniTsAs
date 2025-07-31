<?php

namespace Database\Seeders;

use App\Models\Emprendedor;
use App\Models\Imagenes;
use Illuminate\Database\Seeder;

class ImagenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Emprendedor::factory()
            ->has(Imagenes::factory()->count(5)) // 5 imágenes por emprendedor
            ->count(10)
            ->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Emprendedor;
use App\Models\Imagen;
use Illuminate\Database\Seeder;

class ImagenSeeder extends Seeder
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
            ->has(Imagen::factory()->count(5)) // 5 imágenes por emprendedor
            ->count(10)
            ->create();
    }
}

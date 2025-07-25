<?php

namespace Database\Seeders;

use App\Models\Emprendedor;
use App\Models\Imagen;

use Illuminate\Database\Seeder;
use App\Http\Requests\EmprendedorRequest;
use App\constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

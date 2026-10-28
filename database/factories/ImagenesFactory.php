<?php

namespace Database\Factories;

use App\Models\Emprendedor;
use App\Models\Imagenes;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImagenesFactory extends Factory
{
     protected $model = Imagenes::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // Carpeta donde guardaremos las imágenes de prueba (igual que NoticiasFactory)
        $dir = storage_path('app/public/img/prueba');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $path = $this->faker->image($dir, 640, 480, null, false);

        return [
            'url' => 'imagenes/' . $path,
            'public_id' =>$this->faker->numerify('##########'),
            'emprendedor_id' => Emprendedor::factory(),
        ];
    }
}

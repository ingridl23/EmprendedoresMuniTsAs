<?php

namespace Database\Factories;

use App\Models\Emprendedor;
use App\Models\Imagen;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImagenFactory extends Factory
{
     protected $model = Imagen::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $path = $this->faker->image(public_path('img'), 640, 480, null, false);

        return [
            'url' => 'imagenes/' . $path,
            'emprendedor_id' => Emprendedor::factory(),
        ];
    }
}

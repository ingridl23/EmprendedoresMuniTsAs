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

        $path = $this->faker->image(public_path('img'), 640, 480, null, false);

        return [
            'url' => 'imagenes/' . $path,
            'public_id' =>$this->faker->numerify('##########'),
            'emprendedor_id' => Emprendedor::factory(),
        ];
    }
}

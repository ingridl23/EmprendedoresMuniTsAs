<?php

namespace Database\Factories;

use App\Models\Emprendedor;

use Illuminate\Database\Eloquent\Factories\Factory;

class imagenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $path = $this->faker->image('storage/app/public/imagenes', 640, 480, null, false);

        return [
            'ruta' => 'imagenes/' . $path,
            'emprendedor_id' => Emprendedor::factory(),
        ];
    }
}

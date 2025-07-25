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

        $path = $this->faker->image(public_path('img'), 640, 480, null, false);

        return [
            'url' => 'imagenes/' . $path,
            'emprendedor_id' => Emprendedor::factory(),
        ];
    }
}

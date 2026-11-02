<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DireccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $username = fake()->userName;
        return [
            'ciudad'=>fake()->city,
            'localidad'=>fake()->city,
            'calle' => fake()->streetName,
            'altura' => fake()->numerify('####'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

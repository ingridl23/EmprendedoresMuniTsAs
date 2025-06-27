<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class direccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $username = $this->faker->userName;
        return [
            'ciudad'=>$this->faker->city,
            'calle' => $this->faker->streetName,
            'altura' => $this->faker->numerify('####'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

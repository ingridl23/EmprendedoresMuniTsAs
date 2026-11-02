<?php

namespace Database\Factories;

use  Illuminate\Database\Eloquent\Model;

use App\Models\Empleo;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $modelEmpleo = Empleo::class;


        return [
            //
            'nombre' => fake()->name(),
            'asunto' => fake()->sentence(),
            'email' => fake()->email(),
            'telefono' => fake()->numerify('#########'),
            'edad' => fake()->numberBetween(18, 45),
            'dni' => fake()->unique()->numerify('#########'),
            'ciudad' => fake()->city(),
            'localidad' => fake()->city(),
            'formacion' => fake()->word(),
            'nombre_curso' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'referencia_laboral' => fake()->sentence(),
            'referencia_rubro' => fake()->word(),
            'referencia_actividad' => fake()->sentence(),
            'contratista' => fake()->company(),
            'referencia_telefonica' => fake()->numerify('#########'),
            'cud' => fake()->boolean(),
            'dependencia' => fake()->boolean(),
            'cv_path' => fake()->filePath(),
            'created_at'   => now()


        ];
    }
}

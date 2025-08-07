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
            'nombre' => $this->faker->name(),
            'asunto' => $this->faker->sentence(),
            'email' => $this->faker->email(),
            'telefono' => $this->faker->numerify('#########'),
            'edad' => $this->faker->numberBetween(18, 45),
            'dni' => $this->faker->unique()->numerify('#########'),
            'ciudad' => $this->faker->city(),
            'localidad' => $this->faker->city(),
            'formacion' => $this->faker->word(),
            'nombre_curso' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'referencia_laboral' => $this->faker->sentence(),
            'referencia_rubro' => $this->faker->word(),
            'referencia_actividad' => $this->faker->sentence(),
            'contratista' => $this->faker->company(),
            'referencia_telefonica' => $this->faker->numerify('#########'),
            'cud' => $this->faker->boolean(),
            'dependencia' => $this->faker->boolean(),
            'cv_path' => $this->faker->filePath(),
            'created_at'   => now()


        ];
    }
}

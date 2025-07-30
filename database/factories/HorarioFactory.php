<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{
    public function definition()
    {
        $horaApertura = $this->faker->time('H:i');
        $horaCierre = $this->faker->time('H:i');

        // Nos aseguramos que la hora de cierre sea después
        while (strtotime($horaCierre) <= strtotime($horaApertura)) {
            $horaCierre = $this->faker->time('H:i');
        }

        return [
            'dia' => $this->faker->randomElement([
                'Lunes',
                'Martes',
                'Miércoles',
                'Jueves',
                'Viernes',
                'Sábado',
                'Domingo'
            ]),

            'participa_feria' => $this->faker->boolean(),
            'cerrado' => $this->faker->boolean(),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

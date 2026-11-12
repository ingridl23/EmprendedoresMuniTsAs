<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioFactory extends Factory
{
    public function definition()
    {
        $horaApertura = fake()->time('H:i');
        $horaCierre = fake()->time('H:i');

        // Nos aseguramos que la hora de cierre sea después
        while (strtotime($horaCierre) <= strtotime($horaApertura)) {
            $horaCierre = fake()->time('H:i');
        }

        return [
            'dia' => fake()->randomElement([
                'Lunes',
                'Martes',
                'Miercoles',
                'Jueves',
                'Viernes',
                'Sabado',
                'Domingo'
            ]),

            'participa_feria' => fake()->boolean(),
            'cerrado' => fake()->boolean(),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

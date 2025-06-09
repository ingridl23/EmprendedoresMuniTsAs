<?php

namespace Database\Factories;

use App\Models\Emprendedor;
use App\Models\Redes;
use Illuminate\Database\Eloquent\Factories\Factory;


class EmprendedorFactory extends Factory
{
     protected $model = Emprendedor::class;

    public function definition()
    {
         return [
            'nombre' => $this->faker->company,
            'descripcion' => $this->faker->paragraph,
            'categoria' => $this->faker->randomElement(['Gastronomía', 'Indumentaria', 'Tecnología', 'Servicios']),
            'contacto' => $this->faker->numerify('######'),
            'redes_id' => rand(1, 10),
            'imagen' => $this->faker->imageUrl(640, 480, 'business', true, 'Faker'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

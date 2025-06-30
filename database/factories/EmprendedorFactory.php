<?php

namespace Database\Factories;

use App\Models\Emprendedor;
use App\Models\Redes;
use App\Models\direccion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;


class EmprendedorFactory extends Factory
{
     protected $model = Emprendedor::class;

    public function definition()
    {
         $faker = FakerFactory::create(); // Crear una instancia de Faker
        $redes = redes::factory()->create(); 
        $direccion=direccion::factory()->create();
         return [
            'nombre' => $this->faker->company,
            'descripcion' => $this->faker->paragraph,
            'categoria' => $this->faker->randomElement(['Gastronomía', 'Indumentaria', 'Tecnología', 'Servicios']),
            'redes_id' => rand(1, 10),
            'redes_id' => $redes->id,
            'direccion_id'=>$direccion->id,
            'imagen' => $this->faker->imageUrl(640, 480, 'business', true, 'Faker'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

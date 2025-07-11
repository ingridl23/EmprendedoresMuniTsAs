<?php

namespace Database\Factories;

use App\Models\noticias;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticiasFactory extends Factory
{

    protected $model = Noticias::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = FakerFactory::create(); // Crear una instancia de Faker
        return [

            'id' => $this->faker->id,
            'created_at' => now(),
            'updated_at' => now(),
            'titulo' => $this->faker->company,
            'categoria' => $this->faker->randomElement(['Emprendedor', 'Empresa', 'Evento']),
            'descripcion' => $this->faker->paragraph,

            'imagen' => $this->faker->imageUrl(640, 480, 'business', true, 'Faker'),
        ];
    }
}

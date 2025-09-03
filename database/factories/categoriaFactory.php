<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition()
    {
        return [
            // El campo 'categoria' que definiste en tu modelo
            'categoria' => $this->faker->word(), // genera una palabra random
        ];
    }
}
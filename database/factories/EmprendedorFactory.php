<?php

namespace Database\Factories;

use App\Models\Emprendedor;
use App\Models\Redes;
use App\Models\Direccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmprendedorFactory extends Factory
{
    protected $model = Emprendedor::class;

    public function definition()
    {
        return [
            'nombre'       => $this->faker->company(),
            'descripcion'  => $this->faker->paragraph(),
            'categoria'    => $this->faker->randomElement([
                'Gastronomia',
                'Indumentaria',
                'Tecnologia',
                'Servicios',
                'Artesania'
            ]),
            'redes_id'     => Redes::factory(),
            'direccion_id' => Direccion::factory(),
        ];
    }
}

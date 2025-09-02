<?php

namespace Database\Factories;

use App\Models\Emprendedor;
use App\Models\Redes;
use App\Models\Direccion;
use App\Models\Categoria;
use App\Models\Horario;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmprendedorFactory extends Factory
{
    protected $model = Emprendedor::class;

    public function definition()
    {
        return [
            'nombre'       => $this->faker->company(),
            'descripcion'  => $this->faker->paragraph(),
            'categoria_id'    => Categoria::factory(),
            'redes_id'     => Redes::factory(),
            'direccion_id' => Direccion::factory(),
            'created_at'   => now(),
        ];
    }
}

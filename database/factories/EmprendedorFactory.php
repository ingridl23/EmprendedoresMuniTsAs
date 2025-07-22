<?php

namespace Database\Factories;

use App\Models\Emprendedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmprendedorFactory extends Factory
{
    protected $model = Emprendedor::class;

    public function definition()
    {
        // 1) Carpeta donde guardamos las imágenes
        $dir = storage_path('app/public/assets/img/emprendimientos');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // 2) Generamos la imagen con Faker (built‑in)
        //    Parám posicionales: (ruta, ancho, alto)
        $filePath = $this->faker->image($dir, 640, 480);

        // 3) Convertimos ruta absoluta a relativa
        $relative = str_replace(storage_path('app/public/'), '', $filePath);

        // 4) Creamos registros de redes y dirección
        $redes      = \App\Models\Redes::factory()->create();
        $direccion  = \App\Models\Direccion::factory()->create();

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
            'redes_id'     => $redes->id,
            'direccion_id' => $direccion->id,
            'imagen'       => $relative,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}

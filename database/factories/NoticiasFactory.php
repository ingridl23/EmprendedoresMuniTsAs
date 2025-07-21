<?php

namespace Database\Factories;

use App\Models\Noticias;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoticiasFactory extends Factory
{
    protected $model = Noticias::class;

    public function definition()
    {
        // 1) Carpeta donde guardaremos las imágenes
        $dir = storage_path('app/public/img/prueba');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // 2) Generar la imagen con Faker (built‑in)
        //    Parámetros posicionales: (ruta, ancho, alto)
        $filePath = $this->faker->image($dir, 640, 480);

        // 3) Convertir ruta absoluta a relativa para almacenar en BD
        $relative = str_replace(storage_path('app/public/'), '', $filePath);

        return [
            'titulo'       => $this->faker->company(),
            'categoria'    => $this->faker->randomElement([
                'Emprendedor',
                'Empresa',
                'Evento'
            ]),
            'descripcion'  => $this->faker->paragraph(),
            'imagen'       => $relative,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}

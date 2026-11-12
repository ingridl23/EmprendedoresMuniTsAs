<?php

namespace Database\Factories;

use App\Models\Noticias;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Noticias>
 */
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
        $filePath = fake()->image($dir, 640, 480);

        // 3) Convertir ruta absoluta a relativa para almacenar en BD
        $relative = str_replace(storage_path('app/public/'), '', $filePath);

        return [
            'titulo'       => fake()->company(),
            'categoria'    => fake()->randomElement([
                'Bolsa',
                'Evento'
            ]),
            'descripcion'  => fake()->paragraph(),
            'imagen'       => $relative,
            'imagen_public_id' => fake()->numerify('############'),
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}

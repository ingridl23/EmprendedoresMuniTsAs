<?php

namespace Database\Factories;

use App\Models\noticias;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;

class NoticiasFactory extends Factory
{

    protected $model = Noticias::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
            $faker = app(\Faker\Generator::class);
            // Añadí el proveedor Picsum
            $faker->addProvider(new FakerPicsumImagesProvider($faker));

            // Definí la carpeta donde guardarás las imágenes
            $dir = storage_path('app/public/img/prueba');

            // Asegurate de que exista:
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            // Generá y guardá una imagen de 640×480
            $filePath = $faker->image(dir: $dir, width: 640, height: 480);

            // Luego guardás el _path_ relativo en la DB
            $relative = str_replace(storage_path('app/public/'), '', $filePath);

        return [
            'created_at' => now(),
            'updated_at' => now(),
            'titulo' => $this->faker->company,
            'categoria' => $this->faker->randomElement(['Emprendedor', 'Empresa', 'Evento']),
            'descripcion' => $this->faker->paragraph,
            'imagen' => $relative,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Emprendedor;
use App\Models\Redes;
use App\Models\direccion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;
use Faker\Generator as Faker;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;


class EmprendedorFactory extends Factory
{
     protected $model = Emprendedor::class;

    public function definition()
    {
        $faker = app(\Faker\Generator::class);
            // Añadí el proveedor Picsum
        $faker->addProvider(new FakerPicsumImagesProvider($faker));
        // Definí la carpeta donde guardarás las imágenes
        $dir = storage_path('app/public/img/pruebaEmprendedor');

            // Asegurate de que exista:
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            // Generá y guardá una imagen de 640×480
            $filePath = $faker->image(dir: $dir, width: 640, height: 480);

            // Luego guardás el _path_ relativo en la DB
            $relative = str_replace(storage_path('app/public/'), '', $filePath);
       
        $redes = redes::factory()->create(); 
        $direccion=direccion::factory()->create();
         return [
            'nombre' => $this->faker->company,
            'descripcion' => $this->faker->paragraph,
            'categoria' => $this->faker->randomElement(['Gastronomía', 'Indumentaria', 'Tecnología', 'Servicios']),
            'redes_id' => rand(1, 10),
            'redes_id' => $redes->id,
            'direccion_id'=>$direccion->id,
            'imagen' => $relative,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

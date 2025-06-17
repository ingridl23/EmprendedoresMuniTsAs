<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redes;

class RedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Redes::factory()->count(20)->create(); // genera 20 registros
    }
}

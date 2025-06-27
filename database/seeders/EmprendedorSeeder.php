<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Emprendedor;

class EmprendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Emprendedor::factory()->count(50)->create();
    }
}

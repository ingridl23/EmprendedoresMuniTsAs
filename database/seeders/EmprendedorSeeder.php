<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\emprendedores;

class EmprendedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         emprendedores::factory()->count(50)->create();
    }
}

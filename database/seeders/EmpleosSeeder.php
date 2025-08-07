<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empleo;

class EmpleosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Empleo::factory()->count(50)->create();
    }
}

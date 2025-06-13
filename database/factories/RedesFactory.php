<?php

namespace Database\Factories;

use App\Models\Redes;

use Illuminate\Database\Eloquent\Factories\Factory;

class RedesFactory extends Factory
{
    protected $model = Redes::class;

    public function definition()
    {
        $username = $this->faker->userName;
        return [
            'instagram' => "https://instagram.com/{$username}",
            'facebook' => "https://facebook.com/{$username}",
            'whatsapp' => $this->faker->numerify('#########'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

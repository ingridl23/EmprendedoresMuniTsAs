<?php

namespace Database\Factories;

use App\Models\Redes;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Redes>
 */
class RedesFactory extends Factory
{
    protected $model = Redes::class;

    public function definition()
    {
        $username = fake()->userName;
        return [
            'instagram' => "https://instagram.com/{$username}",
            'facebook' => "https://facebook.com/{$username}",
            'whatsapp' => fake()->numerify('#########'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

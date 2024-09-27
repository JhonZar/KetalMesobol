<?php

namespace Database\Factories;

use App\Models\Talla;
use Illuminate\Database\Eloquent\Factories\Factory;

class TallaFactory extends Factory
{
    protected $model = Talla::class;

    public function definition()
    {
        return [
            'talla' => $this->faker->randomElement(['S', 'M', 'L', 'XL']), // Genera una talla
            'genero' => $this->faker->randomElement([1, 0]), // Genera el género
        ];
    }
}

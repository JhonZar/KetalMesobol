<?php

namespace Database\Factories;

use App\Models\Modelo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModeloFactory extends Factory
{
    protected $model = Modelo::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'precio' => $this->faker->randomFloat(2, 100, 500),
        ];
    }
}

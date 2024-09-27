<?php

namespace Database\Factories;

use App\Models\Colore;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColoreFactory extends Factory
{
    protected $model = Colore::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->hexcolor(), // Genera un código hexadecimal de color
            'nombre' => $this->faker->colorName(), // Genera un nombre de color
        ];
    }
}

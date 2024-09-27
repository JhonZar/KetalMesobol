<?php

namespace Database\Factories;

use App\Models\Sucursale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SucursaleFactory extends Factory
{
    protected $model = Sucursale::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->company(), // Nombre de la sucursal
            'direccion' => $this->faker->address(), // Dirección de la sucursal
            'telefono' => $this->faker->phoneNumber(), // Teléfono
            'estado' => $this->faker->randomElement(['activa', 'inactiva']), // Estado de la sucursal
        ];
    }
}

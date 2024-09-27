<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'id_talla' => \App\Models\Talla::factory(), // Relaciona con una talla
            'id_colores' => \App\Models\Colore::factory(), // Relaciona con un color
            'id_modelo' => \App\Models\Modelo::factory(), // Relaciona con un modelo
            'id_sucursal' => \App\Models\Sucursale::factory(), // Relaciona con una sucursal
            'nombre' => $this->faker->word(),
            'precio_estimado' => $this->faker->randomFloat(2, 50, 500),
            'precio_vendedor' => $this->faker->randomFloat(2, 40, 400),
            'cantidad' => $this->faker->numberBetween(1, 100),
            'descripcion' => $this->faker->sentence(),
            'tipo' => $this->faker->randomElement(['cotizacion', 'venta', 'pedido']),
        ];
    }
}

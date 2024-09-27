<?php
namespace Database\Factories;

use App\Models\DetalleVenta;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleVentaFactory extends Factory
{
    protected $model = DetalleVenta::class;

    public function definition()
    {
        return [
            'id_pedido' => \App\Models\Pedido::factory(), // Relaciona con un pedido
            'id_producto' => \App\Models\Producto::factory(), // Relaciona con un producto
            'cantidad' => $this->faker->numberBetween(1, 10), // Cantidad vendida
            'precion_unitario' => $this->faker->randomFloat(2, 50, 500), // Precio unitario
        ];
    }
}

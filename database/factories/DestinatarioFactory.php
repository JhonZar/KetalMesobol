<?php

namespace Database\Factories;

use App\Models\Destinatario;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinatarioFactory extends Factory
{
    protected $model = Destinatario::class;

    public function definition()
    {
        return [
            'id_pedido' => \App\Models\Pedido::factory(), // Relaciona con un pedido
            'id_cliente' => \App\Models\Cliente::factory(), // Relaciona con un cliente
            'id_producto' => \App\Models\Producto::factory(), // Relaciona con un producto
            'cantidad' => $this->faker->numberBetween(1, 10), // Cantidad del producto
            'fecha_Entrega' => $this->faker->date(),
            'id_talla' => \App\Models\Talla::factory(), // Relaciona con una talla
            'obs' => $this->faker->sentence(),
        ];
    }
}

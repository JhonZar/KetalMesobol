<?php

namespace Database\Factories;

use App\Models\DetalleMateriale;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleMaterialeFactory extends Factory
{
    protected $model = DetalleMateriale::class;

    public function definition()
    {
        return [
            'producto_id' => \App\Models\Producto::factory(), // Relaciona con un producto
            'material_id' => \App\Models\Materiale::factory(), // Relaciona con un material
        ];
    }
}

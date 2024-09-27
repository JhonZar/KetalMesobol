<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Producto;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_un_producto()
    {
        // Crear un producto usando Model Factory
        $producto = Producto::factory()->create([
            'nombre' => 'Producto Test',
            'precio_estimado' => 100.00,
            'precio_vendedor' => 80.00,
            'cantidad' => 50,
            'descripcion' => 'Este es un producto de prueba',
            'tipo' => 'venta'
        ]);

        // Verificar que los datos fueron guardados correctamente
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Producto Test',
            'precio_estimado' => 100.00,
            'precio_vendedor' => 80.00,
            'cantidad' => 50,
            'descripcion' => 'Este es un producto de prueba',
            'tipo' => 'venta'
        ]);
    }
}

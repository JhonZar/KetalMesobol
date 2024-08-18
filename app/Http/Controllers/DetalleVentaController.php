<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Http\Requests\DetalleVentaRequest;
use App\Models\Existencia;
use App\Models\Pedido;
use App\Models\Producto;

/**
 * Class DetalleVentaController
 * @package App\Http\Controllers
 */
class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalleVentas = DetalleVenta::paginate();

        return view('detalle-venta.index', compact('detalleVentas'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleVentas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detalleVenta = new DetalleVenta();
        return view('detalle-venta.create', compact('detalleVenta'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DetalleVentaRequest $request)
    {

        $validated = $request->validated();
        // Suponiendo que cada item en el carrito corresponde a un DetalleVenta diferente
        foreach (session('cart', []) as $id_producto => $item) {
            // Preparar los datos para crear cada DetalleVenta
            $data = [
                'id_pedido' => $validated['id_pedido'], // Este dato viene del formulario
                'id_producto' => $id_producto,          // ID del producto obtenido de la clave del array
                'cantidad' => $item['quantity'],        // Cantidad obtenida de la sesión
                'precion_unitario' => $item['price'],    // Precio unitario obtenido de la sesión
            ];

            // Crear el DetalleVenta con los datos preparados
            DetalleVenta::create($data);
            // Cargar el producto correspondiente
            $producto = Producto::find($id_producto);

            if ($producto) {
                // Restar la cantidad vendida de la existencia del producto
                $producto->cantidad -= $item['quantity'];
                $producto->save();  // Guardar el cambio en la base de datos
                Existencia::create([
                    'id_producto' => $id_producto,
                    'id_usuario' => "1",
                    'id_sucursal' => "2",
                    'fecha' => now(),
                    'cantidad' => $item['quantity'],
                    'tipo_Transaccion' => 'Venta Decremento',
                ]);
            } else {
                // Manejo del error si no se encuentra el producto
                return back()->with('error', 'Producto no encontrado.');
            }
            $pedido = Pedido::find($validated['id_pedido']);
            if (!$pedido) {
                return back()->with('error', 'Pedido no encontrado.');
            }
            $precioTotal = session('total_general', 0);  // Asegura un valor por defecto de 0 si no está en sesión

            // Leer el pago a cuenta desde el input del formulario
            $pagoACuenta = $request->input('pago_cliente', 0);  // Asegura un valor por defecto de 0 si no está en el formulario

            // Calcular el saldo
            $saldo = $precioTotal - $pagoACuenta;
            $pedido->precioTotal = $precioTotal;
            $pedido->pagoACuenta = $pagoACuenta;
            $pedido->saldo = $saldo;
            $pedido->estado = 'Venta Completa';  // Define el estado adecuado, por ejemplo 'Pendiente' o 'Pagado'

            $pedido->save();
            session()->forget(['cart', 'total_general']);
        }
        session()->put('print_pedido_id', $validated['id_pedido']);

        return redirect()->route('detalle-ventas.index')
            ->with('success', 'DetalleVenta created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detalleVenta = DetalleVenta::find($id);

        return view('detalle-venta.show', compact('detalleVenta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detalleVenta = DetalleVenta::find($id);

        return view('detalle-venta.edit', compact('detalleVenta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DetalleVentaRequest $request, DetalleVenta $detalleVenta)
    {
        $detalleVenta->update($request->validated());

        return redirect()->route('detalle-ventas.index')
            ->with('success', 'DetalleVenta updated successfully');
    }

    public function destroy($id)
    {
        DetalleVenta::find($id)->delete();

        return redirect()->route('detalle-ventas.index')
            ->with('success', 'DetalleVenta deleted successfully');
    }
}

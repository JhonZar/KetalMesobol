<?php

namespace App\Http\Controllers;

use App\Events\SendMessageEvent;
use App\Models\Destinatario;
use App\Http\Requests\DestinatarioRequest;
use App\Models\Cliente;
use App\Models\Existencia;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\Talla;
use Illuminate\Http\Request;

/**
 * Class DestinatarioController
 * @package App\Http\Controllers
 */
class DestinatarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $destinatarios = Destinatario::paginate();
        return view('destinatario.index', compact('destinatarios'))
            ->with('i', (request()->input('page', 1) - 1) * $destinatarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destinatario = new Destinatario();
        $clientes = Cliente::all();
        $tallas = Talla::all(); // Cargar todas las tallas disponibles

        // Obtener la información del carrito desde la sesión
        $cart = session('cart', []);
        $firstKey = array_key_first($cart);
        $product = $firstKey ? Producto::find($firstKey) : null;

        // Verificar la cantidad disponible del producto
        $totalProductoDisponible = $product ? $product->cantidad : 0;

        // Pasar las tallas y la cantidad disponible a la vista junto con los otros datos
        return view('destinatario.create', compact('destinatario', 'clientes', 'tallas', 'totalProductoDisponible'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(DestinatarioRequest $request)
    {
        // dd($request->input('client_data'));
        $clientData = json_decode($request->client_data, true); // Decodificar el JSON a array
        $idPedido = session('pasoNroPed'); // Obtener el ID del pedido de la sesión
        $fechaEntrega = $request->fecha_Entrega; // Obtener la fecha de entrega del formulario
        $obs = $request->obs; // Obtener observaciones del formulario
        $pagoACuenta = $request->input('ACC');
        $totalGeneral = session('total_general');

        // Obtener el primer producto y su información desde el carrito almacenado en sesión
        $cart = session('cart', []);
        $firstKey = array_key_first($cart);
        $product = $cart[$firstKey] ?? null;

        if ($product) {
            $idProducto = $firstKey; // ID del producto
            $cantidad = $product['quantity']; // Cantidad del producto
        }
        // Actualizar el pedido
        $pedido = Pedido::find($idPedido);
        if ($pedido) {
            $pedido->precioTotal = $totalGeneral;
            $pedido->pagoACuenta = $pagoACuenta;
            $pedido->saldo = $totalGeneral  - $pagoACuenta;
            $pedido->estado = 'PEDIDO PROCESO';
            $pedido->save();
        }
        // Crear destinatarios
        foreach ($clientData as $data) {
            Destinatario::create([
                'id_pedido' => $idPedido,
                'id_cliente' => $data['id_cliente'],
                'id_producto' => $idProducto ?? null,
                'cantidad' => $data['cantidad'],
                'fecha_Entrega' => $fechaEntrega,
                'id_talla' => $data['id_talla'],
                'obs' => $obs
            ]);
        }

        foreach ($cart as $idProducto => $details) {
            $producto = Producto::find($idProducto);
            if ($producto) {
                $producto->cantidad -= $details['quantity'];
                $producto->save();
                Existencia::create([
                    'id_producto' => $idProducto,
                    'id_usuario' => session('user_id'),
                    'id_sucursal' => session('sucursal_id'),
                    'fecha' => now(),
                    'cantidad' => $details['quantity'],
                    'tipo_Transaccion' => 'Pedido Decremento',
                ]);
            }
        }
        session()->forget(['cart', 'total_general', 'tipoSalida']);

        $message = "Tu pedido ha sido procesado y está en camino.";
        event(new SendMessageEvent($message));
        session()->put('print_pedido_id', $idPedido);
        return redirect()->route('destinatarios.index')
            ->with('success', 'Destinatarios created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $destinatario = Destinatario::find($id);

        return view('destinatario.show', compact('destinatario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $destinatario = Destinatario::find($id);

        return view('destinatario.edit', compact('destinatario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DestinatarioRequest $request, Destinatario $destinatario)
    {
        $destinatario->update($request->validated());

        return redirect()->route('destinatarios.index')
            ->with('success', 'Destinatario updated successfully');
    }

    public function destroy($id)
    {
        Destinatario::find($id)->delete();

        return redirect()->route('destinatarios.index')
            ->with('success', 'Destinatario deleted successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $clientes = Cliente::where('nombre', 'like', '%' . $query . '%')
            ->orWhere('ci', 'like', '%' . $query . '%')
            ->get();

        return response()->json($clientes);
    }
}

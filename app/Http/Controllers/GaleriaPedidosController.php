<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class GaleriaPedidosController extends Controller
{
    public function index()
    {
        // Verificar si existe una sesión llamada 'tipoSalida'
        $tipoSalida = session('tipoSalida');

        // Condición cuando el tipo de salida es 'PEDIDO'
        if ($tipoSalida === 'PEDIDO') {
            $productos = Producto::where('tipo', 'pedido')
                ->where('cantidad', '>', 1)
                ->get();
        }
        // Condición adicional cuando el tipo de salida es 'VENTAS'
        elseif ($tipoSalida === 'VENTAS') {
            $productos = Producto::where('tipo', 'venta')
                ->where('cantidad', '>', 0)
                ->get();
        }
        // Si no es ninguno de los anteriores, cargar todos los productos con cantidad mayor que 1
        else {
            $productos = Producto::where('cantidad', '>', 1)->get();
        }

        // Pasar los productos filtrados a la vista
        return view('galeria-productos.galeria-pedidos', compact('productos'));
    }


    public function show($id)
    {
        $producto = Producto::with(['modelo.imagenModelos', 'colore.imagenColores', 'detalleMateriales.materiale.imagenMateriales'])->findOrFail($id);
        return view('galeria-productos.view-producto', compact('producto'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // default to 1 if not specified
        $price = $request->input('price'); // assume price is passed, or could be retrieved from database

        $product = Producto::find($productId);

        if (!$product || $product->cantidad < $quantity) {
            return redirect()->back()->with('error', 'Cantidad solicitada no disponible.');
        }

        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            // Producto ya está en el carrito, incrementa la cantidad
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Producto no está en el carrito, lo agrega
            $cart[$productId] = ['quantity' => $quantity, 'price' => $price];
        }

        // Reducir la cantidad disponible del producto
        $product->cantidad -= $quantity;
        $product->save();

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }
    public function removeFromCart($productId)
    {
        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }
    public function updateCart(Request $request, $productId)
    {
        $quantity = $request->input('quantity');
        $cart = session('cart', []);

        if (isset($cart[$productId]) && $quantity > 0) {
            $cart[$productId]['quantity'] = $quantity;
            session(['cart' => $cart]);
        } elseif ($quantity == 0) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        return redirect()->back()->with('success', 'Carrito actualizado.');
    }
}

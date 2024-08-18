<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        return view('carrito.index');
    }
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        $productId = $request->product_id;
        $product = Producto::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        $quantityToAdd = $request->quantity;
        $availableStock = $product->cantidad; // Asumiendo que 'cantidad' representa el stock en la tabla productos

        if (isset($cart[$productId])) {
            // Aumentar la cantidad pero no exceder el stock disponible
            $currentQuantity = $cart[$productId]['quantity'];
            $cart[$productId]['quantity'] = min($currentQuantity + $quantityToAdd, $availableStock);
        } else {
            // Agregar nuevo producto al carrito
            $cart[$productId] = [
                'quantity' => min($quantityToAdd, $availableStock),
                'price' => $request->price,
                'name' => $request->name,
                'stock' => $availableStock  // Guarda el stock disponible aquí
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }


    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            $this->calculateTotal();
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }
    public function update(Request $request, $productId)
    {
        $quantity = $request->quantity;
        $cart = session()->get('cart', []);
        $product = Producto::find($productId);
        $availableStock = $product->getAvailableStock();

        if (isset($cart[$productId])) {
            if ($quantity > 0 && $quantity <= $availableStock) {
                $cart[$productId]['quantity'] = $quantity;
            } else {
                return redirect()->back()->with('error', 'Cantidad solicitada no disponible en stock.');
            }

            session()->put('cart', $cart);
            $this->calculateTotal();
        }

        return redirect()->back()->with('success', 'Carrito actualizado.');
    }

    public function calculateTotal()
    {
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        session(['total_general' => $total]); 
    }
}

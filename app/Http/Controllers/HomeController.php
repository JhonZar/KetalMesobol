<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productos = Producto::with('modelo.imagenModelos')
                             ->where('tipo', 'venta')
                             ->get(); // Obtener productos con tipo 'venta' con sus modelos e imágenes
        return view('welcome', compact('productos'));
    }
}

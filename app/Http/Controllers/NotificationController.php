<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getLowStockNotifications()
    {
        $productos = Producto::where('tipo', 'venta')
            ->where('cantidad', '<', 5)
            ->get();

        return response()->json($productos);
    }
}

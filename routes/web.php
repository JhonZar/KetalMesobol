<?php

use App\Http\Controllers\AtencionSucursaleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ColoreController;
use App\Http\Controllers\DestinatarioController;
use App\Http\Controllers\DetalleMaterialeController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\ExistenciaController;
use App\Http\Controllers\GaleriaPedidosController;
use App\Http\Controllers\GeneradorPdfController;
use App\Http\Controllers\HistorialEstadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenColoreController;
use App\Http\Controllers\ImagenMaterialeController;
use App\Http\Controllers\ImagenModeloController;
use App\Http\Controllers\MaterialeController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SucursaleController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('roles', RoleController::class);
Route::resource('sucursales', SucursaleController::class);
Route::resource('clientes', ClienteController::class);

Route::resource('modelos', ModeloController::class);
Route::resource('colores', ColoreController::class);
Route::resource('tallas', TallaController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('materiales', MaterialeController::class);

Route::resource('usuarios', UsuarioController::class);
Route::resource('imagen-materiales', ImagenMaterialeController::class);
Route::resource('atencion-sucursales', AtencionSucursaleController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('imagen-modelos', ImagenModeloController::class);
Route::resource('imagen-colores', ImagenColoreController::class);
Route::resource('detalle-ventas', DetalleVentaController::class);
Route::resource('detalle-materiales', DetalleMaterialeController::class);
Route::resource('estados', EstadoController::class);
Route::resource('existencias', ExistenciaController::class);
Route::resource('historial-estados', HistorialEstadoController::class);

Route::resource('destinatarios', DestinatarioController::class);



///GALERIA////
Route::get('/galeria-pedidos', [GaleriaPedidosController::class, 'index'])->name('galeria.pedidos');
Route::get('/products/{id}', [GaleriaPedidosController::class, 'show'])->name('products.show');


// CARRITO
Route::get('/cart', [CarritoController::class,'index'])->name('cart.index');
Route::post('/cart/add', [CarritoController::class,'add'])->name('cart.add');
Route::patch('/cart/update/{productId}', [CarritoController::class,'update'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CarritoController::class,'remove'])->name('cart.remove');

// BUSCADOR CLIENTE

Route::get('/search-clients', [DestinatarioController::class, 'search']);

// PARTE DE LOGUEO AL SISTEMA
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


use App\Services\WhatsAppService;


Route::get('/test-whatsapp', function (WhatsAppService $whatsapp) {
    $response = $whatsapp->sendWhatsAppMessage('whatsapp:+59167168413', 'Este es un mensaje de prueba como es');

    if (is_array($response) && isset($response['error']) && $response['error']) {
        return 'Error: ' . $response['message'];
    }

    return 'Mensaje de WhatsApp enviado. SID: ' . $response->sid;
});

// parte de asignar pedidos a usuarios

Route::get('/asignar-pedidos', [PedidoController::class, 'asignarPedidosVista'])->name('asignar.pedidos');
Route::post('/asignar-pedidos', [PedidoController::class, 'asignarPedidos'])->name('asignar.pedidos.post');
Route::get('/ver-pedido/{id}', [PedidoController::class, 'verPedido'])->name('ver.pedido');

//TRABAJOS PENDIETES PRODUCCION DE SOMBREROS
Route::get('/trabajos-pendientes', [PedidoController::class, 'trabajosPendientes'])->name('trabajos.pendientes');
Route::put('/pedidos/{id}/actualizar-estado', [PedidoController::class, 'actualizarEstado'])->name('pedidos.actualizarEstados');


// REPORTES

Route::get('reporte-diario', [GeneradorPdfController::class, 'reporteDiario'])->name('reporte-diario');
Route::get('reporte-mensual', [GeneradorPdfController::class, 'reporteMensual'])->name('reporte-mensual');
Route::get('reporte-anual', [GeneradorPdfController::class, 'reporteAnual'])->name('reporte-anual');

// En routes/web.php
Route::get('reportes', [GeneradorPdfController::class, 'index'])->name('reportes.index');
Route::post('reportes/generar', [GeneradorPdfController::class, 'generar'])->name('reportes.generar');
Route::get('pedidos/{id}/imprimir', [PedidoController::class, 'imprimir'])->name('pedidos.print');


Route::put('pedidos/{id}/actualizarEstado', [PedidoController::class, 'actualizarEstadoReg'])->name('pedidos.actualizarEstado');
Route::post('pedidos/{id}/cobrarSaldo', [PedidoController::class, 'cobrarSaldo'])->name('pedidos.cobrarSaldo');

// NOTIFICACION
Route::get('/notifications/low-stock', [NotificationController::class, 'getLowStockNotifications']);


// ACCESO SEGUN TIPO DE USUARIO
Route::group(['middleware' => ['role:ADMINISTRADOR']], function() {
    Route::resource('usuarios', UsuarioController::class);
    Route::get('/asignar-pedidos', [PedidoController::class, 'asignarPedidosVista'])->name('asignar.pedidos');
});

Route::group(['middleware' => ['role:PRODUCCION']], function() {

});

// Rutas accesibles solo para ventas
Route::group(['middleware' => ['role:VENTAS']], function() {

});

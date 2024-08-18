<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Requests\PedidoRequest;
use App\Models\Cliente;
use App\Models\Destinatario;
use App\Models\Estado;
use App\Models\HistorialEstado;
use App\Models\Sucursale;
use App\Models\Usuario;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class PedidoController
 * @package App\Http\Controllers
 */
class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ordena los pedidos por la columna 'fecha' en orden descendente
        $pedidos = Pedido::orderBy('created_at', 'desc')->paginate();

        return view('pedido.index', compact('pedidos'))
            ->with('i', (request()->input('page', 1) - 1) * $pedidos->perPage());
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pedido = new Pedido();
        $clientes = Cliente::all();
        return view('pedido.create', compact('pedido', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PedidoRequest $request)
    {
        $pedido = Pedido::create($request->validated());
        session([
            'tipoSalida' => $request->input('estado'),
            'pasoNroPed' => $pedido->id,
            'id_clie' => $request->input('id_cliente')
        ]);
        return redirect()->route('galeria.pedidos')
            ->with('success', 'Pedido created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pedido = Pedido::find($id);

        return view('pedido.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pedido = Pedido::find($id);
        $clientes = Cliente::all();
        return view('pedido.edit', compact('pedido', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PedidoRequest $request, Pedido $pedido)
    {
        $pedido->update($request->validated());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido updated successfully');
    }

    public function destroy($id)
    {
        Pedido::find($id)->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido deleted successfully');
    }



    // PARTE PARA ASIGNAR PEDIDOS A LOS USUARIOS
    public function asignarPedidosVista(Request $request)
    {
        $filtroSucursal = $request->input('filtro_sucursal');
        $filtroEstado = $request->input('filtro_estado');
        $filtroSaldo = $request->input('filtro_saldo');

        // Obtener pedidos pendientes y cargar relaciones necesarias
        $query = Pedido::with(['cliente', 'detalleVentas.producto', 'destinatarios.cliente', 'destinatarios.producto', 'destinatarios.talla']);

        if ($filtroSucursal) {
            $query->where('id_sucursal', $filtroSucursal);
        }

        if ($filtroEstado) {
            $query->where('estado', $filtroEstado);
        }

        if ($filtroSaldo) {
            if ($filtroSaldo == 'con_saldo') {
                $query->where('saldo', '>', 0);
            } elseif ($filtroSaldo == 'sin_saldo') {
                $query->where('saldo', '=', 0);
            }
        }

        $pedidosFiltrados = $query->get();
        $pedidos = Pedido::with('cliente')->where('estado', 'PEDIDO PROCESO')->get();
        $usuarios = Usuario::all();

        // Obtener sucursales con el conteo de pedidos desglosado por estado y el total de pedidos
        $sucursales = Sucursale::with('pedidos')->get()->map(function ($sucursal) {
            $pedidosByEstado = $sucursal->pedidos->groupBy('estado')->map->count();
            $totalPedidos = $sucursal->pedidos->count();
            $sucursal->setAttribute('pedidos_by_estado', $pedidosByEstado);
            $sucursal->setAttribute('total_pedidos', $totalPedidos);
            return $sucursal;
        });

        return view('asiga-pedido.asignar-pedidos', compact('pedidos', 'usuarios', 'sucursales', 'pedidosFiltrados'));
    }


    public function cobrarSaldo(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $montoACobrar = $request->input('monto_a_cobrar');

        if ($montoACobrar > $pedido->saldo) {
            return redirect()->back()->with('error', 'El monto a cobrar excede el saldo pendiente.');
        }

        $pedido->saldo -= $montoACobrar;
        $pedido->save();

        return redirect()->route('asignar.pedidos.vista')->with('success', 'Saldo cobrado exitosamente.');
    }



    public function asignarPedidos(Request $request)
    {
        $pedidoId = $request->input('pedido_id');
        $usuarioId = $request->input('usuario_id');

        $pedido = Pedido::find($pedidoId);
        $pedido->id_usuario = $usuarioId;
        $pedido->estado = 'ASIGNADO';
        $pedido->save();

        return redirect()->route('asignar.pedidos.post')->with('success', 'Pedido asignado exitosamente.');
    }

    public function verPedido($id)
    {
        $pedido = Pedido::with(['cliente', 'sucursale', 'usuario', 'destinatarios.producto'])->findOrFail($id);
        return view('asiga-pedido.ver-pedido', compact('pedido'));
    }
    // TRABAJOS PENDIENTES


    public function trabajosPendientes()
    {
        // Obtener el ID del usuario desde la sesión
        $userId = session()->get('user_id');

        // Obtener los pedidos pendientes
        $pedidosPendientes = Pedido::with([
            'cliente',
            'sucursale',
            'destinatarios' => function ($query) {
                $query->whereDoesntHave('historialEstados', function ($query) {
                    $query->where('id_estado', function ($subquery) {
                        $subquery->select('id')
                            ->from('estados')
                            ->where('nombre', 'DEVUELTO')
                            ->limit(1);
                    });
                });
            },
            'destinatarios.producto',
            'destinatarios.talla',
            'destinatarios.producto.modelo',
            'destinatarios.producto.colore',
            'destinatarios.historialEstados.estado',
            'destinatarios.historialEstados.usuario'
        ])
            ->where('id_usuario', $userId)
            ->where('estado', 'ASIGNADO')
            ->get();

        $estados = Estado::all(); // Cargar todos los estados disponibles

        return view('pedido.pendientes', compact('pedidosPendientes', 'estados'));
    }



    public function actualizarEstado(Request $request, $id)
    {
        $destinatario = Destinatario::findOrFail($id);
        $nuevoEstado = $request->input('estado');
        $userId = session()->get('user_id');

        // Verificar si el último estado registrado es el mismo que el nuevo estado
        $ultimoHistorial = HistorialEstado::where('id_destinatario', $destinatario->id)
            ->orderBy('fecha', 'desc')
            ->first();

        if ($ultimoHistorial && $ultimoHistorial->id_estado == $nuevoEstado) {
            return redirect()->back()->with('error', 'El estado es el mismo que el último registrado.');
        }

        // Registrar el cambio de estado en el historial
        HistorialEstado::create([
            'id_estado' => $nuevoEstado,
            'id_destinatario' => $destinatario->id,
            'id_usuarios' => $userId,
            'fecha' => now(),
        ]);

        // Verificar si todos los destinatarios del pedido tienen el estado "DEVUELTO"
        $pedido = $destinatario->pedido;
        $todosDevueltos = $pedido->destinatarios->every(function ($dest) {
            $ultimoEstado = $dest->historialEstados()->orderBy('created_at', 'desc')->first();
            return $ultimoEstado && $ultimoEstado->estado->nombre === 'DEVUELTO';
        });
        if ($todosDevueltos) {
            $pedido->estado = 'TERMINADO';
            $pedido->save();
        }

        return redirect()->back()->with('success', 'Estado del destinatario actualizado y registrado en el historial.');
    }


    // REPORTES
    public function generarReporte(Request $request)
    {
        $reportType = $request->input('report_type');
        $date = $request->input('date');

        switch ($reportType) {
            case 'daily':
                $pedidos = Pedido::whereDate('created_at', $date)->get();
                break;
            case 'monthly':
                $pedidos = Pedido::whereMonth('created_at', date('m', strtotime($date)))->whereYear('created_at', date('Y', strtotime($date)))->get();
                break;
            case 'annual':
                $pedidos = Pedido::whereYear('created_at', date('Y', strtotime($date)))->get();
                break;
            default:
                $pedidos = collect();
                break;
        }

        $data = ['pedidos' => $pedidos, 'date' => $date, 'reportType' => ucfirst($reportType)];

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $html = view('reportePedidos', $data)->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('reporte_pedidos_' . $reportType . '.pdf');
    }
    // IMPRIMIR POR CADA REGISTRO
    public function imprimir($id)
    {
        $pedido = Pedido::with(['cliente', 'usuario', 'sucursale', 'detalleVentas.producto', 'destinatarios.producto'])->findOrFail($id);

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pedido.pdf', compact('pedido'))->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return new Response(
            $dompdf->output(),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="comprobante.pdf"'
            ]
        );
    }

    public function actualizarEstadoReg(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $nuevoEstado = $request->input('estado');

        $pedido->estado = $nuevoEstado;
        $pedido->save();

        return redirect()->route('asignar.pedidos')->with('success', 'Estado del pedido actualizado exitosamente.');
    }
}

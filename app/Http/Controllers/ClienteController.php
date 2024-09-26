<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::paginate();

        return view('cliente.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cliente = new Cliente();
        return view('cliente.create', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteRequest $request)
    {
        Cliente::create($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->validated());

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

    public function destroy($id)
    {
        Cliente::find($id)->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deleted successfully');
    }


    public function seguimientoCI()
    {
        return view('seguimientoci');
    }

    public function buscarPorCI(Request $request)
    {
        $ci = $request->input('ci');

        // Validar el CI
        $request->validate([
            'ci' => 'required|string|max:255',
        ]);

        // Buscar el cliente por CI
        $cliente = Cliente::where('ci', $ci)->first();

        if ($cliente) {
            // Obtener los pedidos que no están en estado "TERMINADO"
            $pedidos = $cliente->pedidos()->where('estado', '<>', 'TERMINADO')->get();

            // Contar los estados de los pedidos
            $estadoCounts = $pedidos->groupBy('estado')->map->count();

            return view('cliente.ver-pedido', compact('cliente', 'pedidos', 'estadoCounts'));
        } else {
            return redirect()->route('seguimiento.ci')->withErrors(['ci' => 'Cliente no encontrado']);
        }
    }
}

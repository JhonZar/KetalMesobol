<?php

namespace App\Http\Controllers;

use App\Models\HistorialEstado;
use App\Http\Requests\HistorialEstadoRequest;

/**
 * Class HistorialEstadoController
 * @package App\Http\Controllers
 */
class HistorialEstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historialEstados = HistorialEstado::paginate();

        return view('historial-estado.index', compact('historialEstados'))
            ->with('i', (request()->input('page', 1) - 1) * $historialEstados->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $historialEstado = new HistorialEstado();
        return view('historial-estado.create', compact('historialEstado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HistorialEstadoRequest $request)
    {
        HistorialEstado::create($request->validated());

        return redirect()->route('historial-estados.index')
            ->with('success', 'HistorialEstado created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $historialEstado = HistorialEstado::find($id);

        return view('historial-estado.show', compact('historialEstado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $historialEstado = HistorialEstado::find($id);

        return view('historial-estado.edit', compact('historialEstado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HistorialEstadoRequest $request, HistorialEstado $historialEstado)
    {
        $historialEstado->update($request->validated());

        return redirect()->route('historial-estados.index')
            ->with('success', 'HistorialEstado updated successfully');
    }

    public function destroy($id)
    {
        HistorialEstado::find($id)->delete();

        return redirect()->route('historial-estados.index')
            ->with('success', 'HistorialEstado deleted successfully');
    }
}

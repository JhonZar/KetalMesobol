<?php

namespace App\Http\Controllers;

use App\Models\Existencia;
use App\Http\Requests\ExistenciaRequest;

/**
 * Class ExistenciaController
 * @package App\Http\Controllers
 */
class ExistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $existencias = Existencia::paginate();

        return view('existencia.index', compact('existencias'))
            ->with('i', (request()->input('page', 1) - 1) * $existencias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $existencia = new Existencia();
        return view('existencia.create', compact('existencia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExistenciaRequest $request)
    {
        Existencia::create($request->validated());

        return redirect()->route('existencias.index')
            ->with('success', 'Existencia created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $existencia = Existencia::find($id);

        return view('existencia.show', compact('existencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $existencia = Existencia::find($id);

        return view('existencia.edit', compact('existencia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExistenciaRequest $request, Existencia $existencia)
    {
        $existencia->update($request->validated());

        return redirect()->route('existencias.index')
            ->with('success', 'Existencia updated successfully');
    }

    public function destroy($id)
    {
        Existencia::find($id)->delete();

        return redirect()->route('existencias.index')
            ->with('success', 'Existencia deleted successfully');
    }
}

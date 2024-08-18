<?php

namespace App\Http\Controllers;

use App\Models\Sucursale;
use App\Http\Requests\SucursaleRequest;

/**
 * Class SucursaleController
 * @package App\Http\Controllers
 */
class SucursaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sucursales = Sucursale::paginate();

        return view('sucursale.index', compact('sucursales'))
            ->with('i', (request()->input('page', 1) - 1) * $sucursales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sucursale = new Sucursale();
        return view('sucursale.create', compact('sucursale'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SucursaleRequest $request)
    {
        Sucursale::create($request->validated());

        return redirect()->route('sucursales.index')
            ->with('success', 'Sucursale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sucursale = Sucursale::find($id);

        return view('sucursale.show', compact('sucursale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sucursale = Sucursale::find($id);

        return view('sucursale.edit', compact('sucursale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SucursaleRequest $request, Sucursale $sucursale)
    {
        $sucursale->update($request->validated());

        return redirect()->route('sucursales.index')
            ->with('success', 'Sucursale updated successfully');
    }

    public function destroy($id)
    {
        Sucursale::find($id)->delete();

        return redirect()->route('sucursales.index')
            ->with('success', 'Sucursale deleted successfully');
    }
}

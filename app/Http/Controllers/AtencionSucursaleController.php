<?php

namespace App\Http\Controllers;

use App\Models\AtencionSucursale;
use App\Http\Requests\AtencionSucursaleRequest;

/**
 * Class AtencionSucursaleController
 * @package App\Http\Controllers
 */
class AtencionSucursaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atencionSucursales = AtencionSucursale::paginate();

        return view('atencion-sucursale.index', compact('atencionSucursales'))
            ->with('i', (request()->input('page', 1) - 1) * $atencionSucursales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $atencionSucursale = new AtencionSucursale();
        return view('atencion-sucursale.create', compact('atencionSucursale'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AtencionSucursaleRequest $request)
    {
        AtencionSucursale::create($request->validated());

        return redirect()->route('atencion-sucursales.index')
            ->with('success', 'AtencionSucursale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $atencionSucursale = AtencionSucursale::find($id);

        return view('atencion-sucursale.show', compact('atencionSucursale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $atencionSucursale = AtencionSucursale::find($id);

        return view('atencion-sucursale.edit', compact('atencionSucursale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtencionSucursaleRequest $request, AtencionSucursale $atencionSucursale)
    {
        $atencionSucursale->update($request->validated());

        return redirect()->route('atencion-sucursales.index')
            ->with('success', 'AtencionSucursale updated successfully');
    }

    public function destroy($id)
    {
        AtencionSucursale::find($id)->delete();

        return redirect()->route('atencion-sucursales.index')
            ->with('success', 'AtencionSucursale deleted successfully');
    }
}

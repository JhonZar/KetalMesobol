<?php

namespace App\Http\Controllers;

use App\Models\DetalleMateriale;
use App\Http\Requests\DetalleMaterialeRequest;

/**
 * Class DetalleMaterialeController
 * @package App\Http\Controllers
 */
class DetalleMaterialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalleMateriales = DetalleMateriale::paginate();

        return view('detalle-materiale.index', compact('detalleMateriales'))
            ->with('i', (request()->input('page', 1) - 1) * $detalleMateriales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detalleMateriale = new DetalleMateriale();
        return view('detalle-materiale.create', compact('detalleMateriale'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DetalleMaterialeRequest $request)
    {
        DetalleMateriale::create($request->validated());

        return redirect()->route('detalle-materiales.index')
            ->with('success', 'DetalleMateriale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detalleMateriale = DetalleMateriale::find($id);

        return view('detalle-materiale.show', compact('detalleMateriale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detalleMateriale = DetalleMateriale::find($id);

        return view('detalle-materiale.edit', compact('detalleMateriale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DetalleMaterialeRequest $request, DetalleMateriale $detalleMateriale)
    {
        $detalleMateriale->update($request->validated());

        return redirect()->route('detalle-materiales.index')
            ->with('success', 'DetalleMateriale updated successfully');
    }

    public function destroy($id)
    {
        DetalleMateriale::find($id)->delete();

        return redirect()->route('detalle-materiales.index')
            ->with('success', 'DetalleMateriale deleted successfully');
    }
}

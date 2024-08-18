<?php

namespace App\Http\Controllers;

use App\Models\ImagenModelo;
use App\Http\Requests\ImagenModeloRequest;

/**
 * Class ImagenModeloController
 * @package App\Http\Controllers
 */
class ImagenModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imagenModelos = ImagenModelo::paginate();

        return view('imagen-modelo.index', compact('imagenModelos'))
            ->with('i', (request()->input('page', 1) - 1) * $imagenModelos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $imagenModelo = new ImagenModelo();
        return view('imagen-modelo.create', compact('imagenModelo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImagenModeloRequest $request)
    {
        ImagenModelo::create($request->validated());

        return redirect()->route('imagen-modelos.index')
            ->with('success', 'ImagenModelo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $imagenModelo = ImagenModelo::find($id);

        return view('imagen-modelo.show', compact('imagenModelo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $imagenModelo = ImagenModelo::find($id);

        return view('imagen-modelo.edit', compact('imagenModelo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImagenModeloRequest $request, ImagenModelo $imagenModelo)
    {
        $imagenModelo->update($request->validated());

        return redirect()->route('imagen-modelos.index')
            ->with('success', 'ImagenModelo updated successfully');
    }

    public function destroy($id)
    {
        ImagenModelo::find($id)->delete();

        return redirect()->route('imagen-modelos.index')
            ->with('success', 'ImagenModelo deleted successfully');
    }
}

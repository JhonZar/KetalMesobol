<?php

namespace App\Http\Controllers;

use App\Models\ImagenColore;
use App\Http\Requests\ImagenColoreRequest;

/**
 * Class ImagenColoreController
 * @package App\Http\Controllers
 */
class ImagenColoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imagenColores = ImagenColore::paginate();

        return view('imagen-colore.index', compact('imagenColores'))
            ->with('i', (request()->input('page', 1) - 1) * $imagenColores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $imagenColore = new ImagenColore();
        return view('imagen-colore.create', compact('imagenColore'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImagenColoreRequest $request)
    {
        ImagenColore::create($request->validated());

        return redirect()->route('imagen-colores.index')
            ->with('success', 'ImagenColore created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $imagenColore = ImagenColore::find($id);

        return view('imagen-colore.show', compact('imagenColore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $imagenColore = ImagenColore::find($id);

        return view('imagen-colore.edit', compact('imagenColore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImagenColoreRequest $request, ImagenColore $imagenColore)
    {
        $imagenColore->update($request->validated());

        return redirect()->route('imagen-colores.index')
            ->with('success', 'ImagenColore updated successfully');
    }

    public function destroy($id)
    {
        ImagenColore::find($id)->delete();

        return redirect()->route('imagen-colores.index')
            ->with('success', 'ImagenColore deleted successfully');
    }
}

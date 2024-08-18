<?php

namespace App\Http\Controllers;

use App\Models\ImagenMateriale;
use App\Http\Requests\ImagenMaterialeRequest;

/**
 * Class ImagenMaterialeController
 * @package App\Http\Controllers
 */
class ImagenMaterialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imagenMateriales = ImagenMateriale::paginate();

        return view('imagen-materiale.index', compact('imagenMateriales'))
            ->with('i', (request()->input('page', 1) - 1) * $imagenMateriales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $imagenMateriale = new ImagenMateriale();
        return view('imagen-materiale.create', compact('imagenMateriale'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImagenMaterialeRequest $request)
    {
        ImagenMateriale::create($request->validated());

        return redirect()->route('imagen-materiales.index')
            ->with('success', 'ImagenMateriale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $imagenMateriale = ImagenMateriale::find($id);

        return view('imagen-materiale.show', compact('imagenMateriale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $imagenMateriale = ImagenMateriale::find($id);

        return view('imagen-materiale.edit', compact('imagenMateriale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImagenMaterialeRequest $request, ImagenMateriale $imagenMateriale)
    {
        $imagenMateriale->update($request->validated());

        return redirect()->route('imagen-materiales.index')
            ->with('success', 'ImagenMateriale updated successfully');
    }

    public function destroy($id)
    {
        ImagenMateriale::find($id)->delete();

        return redirect()->route('imagen-materiales.index')
            ->with('success', 'ImagenMateriale deleted successfully');
    }
}

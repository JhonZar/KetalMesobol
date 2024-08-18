<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Http\Requests\ModeloRequest;

/**
 * Class ModeloController
 * @package App\Http\Controllers
 */
class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelos = Modelo::paginate();

        return view('modelo.index', compact('modelos'))
            ->with('i', (request()->input('page', 1) - 1) * $modelos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modelo = new Modelo();
        return view('modelo.create', compact('modelo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModeloRequest $request)
    {
        $validatedData = $request->validated();

        // Crear el modelo
        $modelo = Modelo::create($validatedData);

        // Procesar y mover las imágenes a la carpeta public
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                // Generar un nombre único para cada imagen
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                // Mover la imagen a la carpeta public
                $imagen->move(public_path('imagenes'), $nombreImagen);
                // Crear una entrada en la base de datos para la imagen
                $modelo->imagenes()->create(['url' => 'imagenes/' . $nombreImagen]);
            }
        }

        return redirect()->route('modelos.index')
            ->with('success', 'Modelo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $modelo = Modelo::find($id);

        return view('modelo.show', compact('modelo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $modelo = Modelo::findOrFail($id);
        $imagenes = $modelo->imagenes;

        return view('modelo.edit', compact('modelo', 'imagenes'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ModeloRequest $request, Modelo $modelo)
    {
        // Actualizar los datos del modelo
        $modelo->update($request->validated());

        // Si se han subido nuevas imágenes, procesarlas
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes'), $nombreImagen);

                // Crear la relación en la base de datos
                // Asegúrate de proporcionar un valor para el campo 'url'
                $modelo->imagenes()->create(['url' => 'imagenes/' . $nombreImagen]);
            }
        }

        return redirect()->route('modelos.index')
            ->with('success', 'Modelo updated successfully');
    }

    public function destroy($id)
    {
        Modelo::find($id)->delete();

        return redirect()->route('modelos.index')
            ->with('success', 'Modelo deleted successfully');
    }
}

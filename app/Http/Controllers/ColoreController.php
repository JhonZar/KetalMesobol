<?php

namespace App\Http\Controllers;

use App\Models\Colore;
use App\Http\Requests\ColoreRequest;

/**
 * Class ColoreController
 * @package App\Http\Controllers
 */
class ColoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colores = Colore::paginate();

        return view('colore.index', compact('colores'))
            ->with('i', (request()->input('page', 1) - 1) * $colores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colore = new Colore();
        return view('colore.create', compact('colore'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColoreRequest $request)
    {
        $colore = Colore::create($request->validated());

        // Verificar si se han subido imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $nombreImagen = 'colores' . time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes'), $nombreImagen);

                // Crear la relación en la base de datos
                $colore->imagenColores()->create([
                    'url' => 'imagenes/' . $nombreImagen,
                    'color_id' => $colore->id // Aquí asignamos el color_id correcto
                ]);
            }
        }

        return redirect()->route('colores.index')
            ->with('success', 'Colore created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $colore = Colore::find($id);

        return view('colore.show', compact('colore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $colore = Colore::find($id);
        $imagenes = $colore->imagenColores; // Obtener las imágenes asociadas al color
        // dd($imagenes);
        return view('colore.edit', compact('colore', 'imagenes'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ColoreRequest $request, Colore $colore)
    {
        // Actualizar los datos del color
        $colore->update($request->validated());

        // Si se han subido nuevas imágenes, procesarlas
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes'), $nombreImagen);

                // Crear la relación en la base de datos
                // Asegúrate de proporcionar un valor para el campo 'url'
                $colore->imagenColores()->create(['url' => 'imagenes/' . $nombreImagen]);
            }
        }

        return redirect()->route('colores.index')
            ->with('success', 'Colore updated successfully');
    }



    public function destroy($id)
    {
        Colore::find($id)->delete();

        return redirect()->route('colores.index')
            ->with('success', 'Colore deleted successfully');
    }
}

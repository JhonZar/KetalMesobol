<?php

namespace App\Http\Controllers;

use App\Models\Materiale;
use App\Http\Requests\MaterialeRequest;
use App\Models\Categoria;
use App\Models\ImagenMateriale;

/**
 * Class MaterialeController
 * @package App\Http\Controllers
 */
class MaterialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiales = Materiale::paginate();

        return view('materiale.index', compact('materiales'))
            ->with('i', (request()->input('page', 1) - 1) * $materiales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materiale = new Materiale();
        $categorias = Categoria::all();
        return view('materiale.create', compact('categorias', 'materiale'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialeRequest $request)
    {
        // Crear el material
        $material = Materiale::create($request->validated());

        // Guardar las imágenes
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName); // Guardar la imagen en public/images
                ImagenMateriale::create([
                    'material_id' => $material->id,
                    'url' => 'images/' . $imageName, // Ruta relativa al directorio public
                ]);
            }
        }

        return redirect()->route('materiales.index')
            ->with('success', 'Materiale created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $materiale = Materiale::find($id);

        return view('materiale.show', compact('materiale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $materiale = Materiale::findOrFail($id);
        $categorias = Categoria::all();
        $imagenes = ImagenMateriale::where('material_id', $id)->get();
        return view('materiale.edit', compact('materiale', 'categorias', 'imagenes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialeRequest $request, Materiale $materiale)
    {
        $materiale->update($request->validated());

        // Actualizar las imágenes
        if ($request->hasFile('imagenes')) {
            // Eliminar las imágenes anteriores si es necesario
            ImagenMateriale::where('material_id', $materiale->id)->delete();

            // Guardar las nuevas imágenes
            foreach ($request->file('imagenes') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName); // Guardar la imagen en public/images
                ImagenMateriale::create([
                    'material_id' => $materiale->id,
                    'url' => 'images/' . $imageName, // Ruta relativa al directorio public
                ]);
            }
        }

        return redirect()->route('materiales.index')
            ->with('success', 'Materiale updated successfully');
    }


    public function destroy($id)
    {
        Materiale::find($id)->delete();

        return redirect()->route('materiales.index')
            ->with('success', 'Materiale deleted successfully');
    }
}

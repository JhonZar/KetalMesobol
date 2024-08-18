<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\ProductoRequest;
use App\Models\Categoria;
use App\Models\Colore;
use App\Models\DetalleMateriale;
use App\Models\Materiale;
use App\Models\Modelo;
use App\Models\Talla;

/**
 * Class ProductoController
 * @package App\Http\Controllers
 */
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::paginate();

        return view('producto.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $producto = new Producto();
        $modelos = Modelo::all();
        $tallas = Talla::all();
        // Carga anticipada de colores e imágenes de colores
        $colores = Colore::with('imagenColores')->get();
        $materiales = Materiale::all();
        $categorias = Categoria::all();
        return view('producto.create', compact('producto', 'modelos', 'tallas', 'colores', 'materiales', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        // Extraer sucursal_id de la sesión
        $sucursalId = session('sucursal_id');

        // Verificar si sucursalId está presente en la sesión
        if (is_null($sucursalId)) {
            return redirect()->back()->withErrors('No se ha definido una sucursal para este usuario. Intente iniciar sesión nuevamente.');
        }

        // Crear el producto usando los datos validados y añadiendo sucursal_id
        $validatedData = $request->validated();
        $validatedData['id_sucursal'] = $sucursalId; // Asegúrate de que 'id_sucursal' esté en el fillable del modelo Producto
        $producto = Producto::create($validatedData);

        // Verificar si se han seleccionado materiales y decodificar el JSON
        if ($request->has('selectedMaterials')) {
            $selectedMaterials = json_decode($request->selectedMaterials, true);

            // Iterar sobre cada material seleccionado y crear una entrada de detalle para cada uno
            foreach ($selectedMaterials as $categoriaId => $materialId) {
                DetalleMateriale::create([
                    'producto_id' => $producto->id,
                    'material_id' => $materialId
                ]);
            }
        }

        // Redirigir con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        return view('producto.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $modelos = Modelo::all();
        $tallas = Talla::all();
        // Carga anticipada de colores e imágenes de colores
        $colores = Colore::with('imagenColores')->get();
        $materiales = Materiale::all();
        $categorias = Categoria::all();
        return view('producto.edit', compact('producto', 'modelos', 'tallas', 'colores', 'materiales', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());

        return redirect()->route('productos.index')
            ->with('success', 'Producto updated successfully');
    }

    public function destroy($id)
    {
        Producto::find($id)->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto deleted successfully');
    }
}

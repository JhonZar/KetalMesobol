<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use App\Http\Requests\TallaRequest;

/**
 * Class TallaController
 * @package App\Http\Controllers
 */
class TallaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tallas = Talla::paginate();

        return view('talla.index', compact('tallas'))
            ->with('i', (request()->input('page', 1) - 1) * $tallas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $talla = new Talla();
        return view('talla.create', compact('talla'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TallaRequest $request)
    {
        Talla::create($request->validated());

        return redirect()->route('tallas.index')
            ->with('success', 'Talla created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $talla = Talla::find($id);

        return view('talla.show', compact('talla'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $talla = Talla::find($id);

        return view('talla.edit', compact('talla'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TallaRequest $request, Talla $talla)
    {
        $talla->update($request->validated());

        return redirect()->route('tallas.index')
            ->with('success', 'Talla updated successfully');
    }

    public function destroy($id)
    {
        Talla::find($id)->delete();

        return redirect()->route('tallas.index')
            ->with('success', 'Talla deleted successfully');
    }
}

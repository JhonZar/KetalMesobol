<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use App\Models\Role;

/**
 * Class UsuarioController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::paginate();

        return view('usuario.index', compact('usuarios'))
            ->with('i', (request()->input('page', 1) - 1) * $usuarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = new Usuario();
        $roles = Role::all();  // Fetch all roles from the Role model
        return view('usuario.create', compact('usuario', 'roles'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioRequest $request)
    {
        $validated = $request->validated();
        $validated['contra'] = bcrypt($validated['contra']); // Asegúrate de encriptar la contraseña
        Usuario::create($validated);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);

        return view('usuario.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = Usuario::find($id);
        $roles = Role::all();
        return view('usuario.edit', compact('usuario','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        $data = $request->validated();

        // Verificar si el campo de contraseña fue proporcionado y no está vacío.
        if (!empty($data['contra'])) {
            $data['contra'] = bcrypt($data['contra']);  // Encriptar la nueva contraseña antes de guardarla.
        } else {
            unset($data['contra']);  // Evitar actualizar la contraseña si no se proporciona.
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario updated successfully');
    }

    public function destroy($id)
    {
        Usuario::find($id)->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario deleted successfully');
    }
}

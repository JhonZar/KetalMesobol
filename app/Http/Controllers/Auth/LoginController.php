<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Sucursale;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $sucursales = Sucursale::where('estado', '1')->get();  // Asumiendo que solo quieres sucursales activas
        return view('auth.login', compact('sucursales'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'contra' => 'required',
            'sucursal_id' => 'required'
        ]);

        $user = Usuario::where('nombre', $request->nombre)->with('role')->first();

        if ($user && $user->estado == 1 && Hash::check($request->contra, $user->getAuthPassword())) {
            // Crear una sesión para el usuario y la sucursal seleccionada
            $request->session()->put('user_id', $user->id);
            $request->session()->put('sucursal_id', $request->sucursal_id);
            $request->session()->put('nombreusu', $user->nombre);
            $request->session()->put('user_role', $user->role->nombre); // Guarda el rol del usuario en la sesión

            Auth::login($user);

            return redirect()->intended('tallas');
        }

        $errorMessage = 'Las credenciales proporcionadas no coinciden con nuestros registros.';
        if ($user && $user->estado != 1) {
            $errorMessage = 'El usuario no está activo. Contantate con el administrador ';
        }

        return back()->withErrors([
            'nombre' => $errorMessage,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

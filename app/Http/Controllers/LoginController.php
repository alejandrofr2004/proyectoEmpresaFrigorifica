<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Procesa el inicio de sesión.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'El campo de email es obligatorio.',
            'email.email' => 'Introduce un email válido, como nombre@example.com.',
            'password.required' => 'Debes ingresar una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Si la autenticación es exitosa, verificar el rol del usuario
            $user = Auth::user();  // Obtener el usuario autenticado

            // Redirigir dependiendo del rol
            if ($user->hasRole('admin')) {
                return redirect()->route('admin');  // Redirige al dashboard de admin
            } elseif ($user->hasRole('empleado')) {
                return redirect()->route('admin');  // Redirige al dashboard de empleado
            } else {
                return redirect()->route('index');  // Redirige a la página principal para clientes
            }
        }

        // Si la autenticación falla, redirigir al login con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ]);
    }

    /**
     * Salir del sistema.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

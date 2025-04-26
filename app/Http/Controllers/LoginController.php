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
        // Intentar autenticar al usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Verificar el rol del usuario
            $user = Auth::user();

            if ($user->role === 'cliente') {
                // Si el usuario tiene el rol 'cliente', redirigir a la página deseada para clientes
                return redirect()->intended(route('index'));
            } elseif ($user->role === 'admin') {
                // Si el usuario tiene el rol 'admin', redirigir a la página deseada para administradores
                return redirect()->intended(route('admin'));
            } else {
                // Si el usuario no tiene rol reconocido, desautenticamos y mostramos error
                Auth::logout();
                return back()->withErrors(['email' => 'No tienes acceso a esta área.']);
            }
        }

        // Si la autenticación falla, redirigir al login con un mensaje de error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
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
        return redirect('/login');
    }
}

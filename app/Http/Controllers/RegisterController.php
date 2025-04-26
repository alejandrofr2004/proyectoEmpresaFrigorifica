<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|confirmed|min:8',
        ], [
            'first_name.required' => 'El campo de nombre es obligatorio.',
            'first_name.string' => 'El nombre debe ser una cadena de texto.',
            'first_name.max' => 'El nombre no puede exceder los 255 caracteres.',

            'last_name.required' => 'El campo de apellido es obligatorio.',
            'last_name.string' => 'El apellido debe ser una cadena de texto.',
            'last_name.max' => 'El apellido no puede exceder los 255 caracteres.',

            'email.required' => 'El campo de email es obligatorio.',
            'email.email' => 'Introduce un email válido, como nombre@example.com.',
            'email.max' => 'El email no puede exceder los 255 caracteres.',
            'email.unique' => 'Este email ya está registrado.',

            'phone.required' => 'El campo de teléfono es obligatorio.',
            'phone.string' => 'El teléfono debe ser una cadena de texto.',
            'phone.max' => 'El teléfono no puede exceder los 15 caracteres.',

            'password.required' => 'Debes ingresar una contraseña.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        // Si la validación falla, redirigir al formulario anterior con los errores y los datos ingresados previamente
        if ($validator->fails()) {
            // Redirige de vuelta a la página anterior con los errores de validación y los datos que el usuario ingresó
            return redirect()->back()
                ->withErrors($validator) // Pasar los errores de validación a la vista
                ->withInput(); // Mantener los datos que el usuario ingresó previamente en los campos del formulario
        }

        // Crear el usuario
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telefono' => $request->phone,
            'role' => 'cliente',
            'password' => Hash::make($request->password),
        ]);

        // Crear una entrada en la tabla de clientes
        /*Cliente::create([
            'user_id' => $user->id,
            'direccion' => '',  // O puedes dejarla vacía si decides agregar direcciones después
        ]);*/

        // Redirigir al usuario a la página de inicio de sesión o a donde desees
        return redirect()->route('login')->with('success', 'Te has registrado correctamente. Por favor, inicia sesión.');
    }
}

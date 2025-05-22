<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Metodo que muestra el register
     */
    public function showRegistrationForm()
    {
        return view('register');
    }

    /**
     * Metodo que valida el register
     */
    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:9|max:15',
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
            'phone.min' => 'El teléfono debe tener al menos 9 dígitos.',
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
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('cliente');

        // Crear un cliente en la tabla clientes
        Client::create([
            'user_id'   => $user->id,
            'telefono'  => $user->phone,
            'direccion' => null
        ]);

        // Redirigir al usuario a la página de inicio de sesión
        return redirect()->route('login')->with('success', 'Te has registrado correctamente. Por favor, inicia sesión.');
    }
}

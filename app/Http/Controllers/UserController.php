<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Función para mostrar todos los usuarios.
     */
    public function index()
    {
        $usuarios = User::all();
        return view('showUsers', compact('usuarios'));
    }

    /**
     * Devuelve la vista para crear un usuario.
     */
    public function create()
    {
        $roles = Role::pluck('name');
        return view('editUser', compact('roles'));
    }

    /**
     * Función que comprueba los datos en la creación de un usuario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6|confirmed',
            'phone'      => 'nullable|string|min:9|max:20',
            'role'       => 'required|in:admin,cliente,empleado'
        ], [
            'first_name.required' => 'El nombre es obligatorio.',
            'first_name.string'   => 'El nombre debe ser una cadena de texto.',
            'last_name.required'  => 'El apellido es obligatorio.',
            'last_name.string'    => 'El apellido debe ser una cadena de texto.',
            'email.required'      => 'El correo electrónico es obligatorio.',
            'email.email'         => 'Debe ser un correo electrónico válido.',
            'email.unique'        => 'Este correo ya está registrado.',
            'password.required'   => 'La contraseña es obligatoria.',
            'password.string'     => 'La contraseña debe ser una cadena de texto.',
            'password.min'        => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed'  => 'Las contraseñas no coinciden.',
            'phone.string'        => 'El teléfono debe ser una cadena de texto.',
            'phone.min'           => 'El teléfono debe tener al menos 9 caracteres.',
            'phone.max'           => 'El teléfono no puede exceder los 20 caracteres.',
            'role' => 'required|exists:roles,name'
        ]);


        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'phone'      => $request->phone,
        ]);

        $user->assignRole($request->role);

        return redirect()->route('showUsers')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Función que devuelve la vista para editar un usuario.
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Role::pluck('name');
        return view('editUser', compact('usuario', 'roles'));
    }

    /**
     * Función que comprueba la actualización de un usuario.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $usuario->id,  // Validación única excepto para el propio usuario
            'password'   => 'nullable|string|min:6|confirmed', // Contraseña opcional
            'phone'      => 'nullable|string|max:20',
            'role' => 'required|exists:roles,name'
        ], [
            'first_name.required' => 'El nombre es obligatorio.',
            'last_name.required'  => 'El apellido es obligatorio.',
            'email.required'      => 'El correo electrónico es obligatorio.',
            'email.email'         => 'Debe ser un correo electrónico válido.',
            'email.unique'        => 'Este correo ya está registrado.',
            'password.required'   => 'La contraseña es obligatoria.',
            'password.min'        => 'La contraseña debe tener al menos 6 caracteres.',
            'role.required'       => 'El rol es obligatorio.',
            'password.confirmed'  => 'Las contraseñas no coinciden.'
        ]);

        $usuario->first_name = $request->first_name;
        $usuario->last_name  = $request->last_name;
        $usuario->email      = $request->email;
        $usuario->phone      = $request->phone;

        $usuario->assignRole($request->role);

        // Verifica si el campo 'password' tiene un valor lleno (no vacío ni nulo).
        // Si el campo 'password' tiene algún valor, se actualiza la contraseña
        // del usuario con el valor ingresado, cifrando la nueva contraseña con Hash::make().
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('showUsers')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Función que borra un usuario.
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('showUsers')->with('success', 'Usuario eliminado exitosamente.');
    }
}

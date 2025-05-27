<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Función para listar todas las categorías y devolver la vista con ellas
     */
    public function index()
    {
        $categorias = Category::with('parent')->get();
        return view('showCategories', compact('categorias'));
    }

    /**
     * Función para mostrar la vista de crear una categoría (pasándole las demás categorías para elegir padre)
     */
    public function create()
    {
        $categorias = Category::all();
        return view('editCategory', compact('categorias'));
    }

    /**
     * Función para validar y guardar una nueva categoría
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'padre_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagenPath = null;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $nombreImagen = strtolower(str_replace(' ', '_', $request->nombre)) . '.' . $extension;
            $imagen->move(public_path('img'), $nombreImagen);
            $imagenPath = 'img/' . $nombreImagen;
        }

        Category::create([
            'nombre' => $request->nombre,
            'padre_id' => $request->padre_id,
            'imagen' => $imagenPath,
        ]);

        return redirect()->route('showCategories')->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Función para mostrar la vista de editar una categoría (pasándole las demás categorías para elegir padre)
     */
    public function edit($id)
    {
        $categoria = Category::findOrFail($id);
        $categorias = Category::where('id', '!=', $id)->get(); // Para evitar que sea su propio padre
        return view('editCategory', compact('categoria', 'categorias'));
    }

    /**
     * Función para validar y actualizar una categoría existente
     */
    public function update(Request $request, $id)
    {
        $categoria = Category::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'padre_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $nombreImagen = strtolower(str_replace(' ', '_', $request->nombre)) . '.' . $extension;
            $imagen->move(public_path('img'), $nombreImagen);
            $categoria->imagen_url = 'img/' . $nombreImagen;
        }

        $categoria->update([
            'nombre' => $request->nombre,
            'padre_id' => $request->padre_id,
        ]);

        return redirect()->route('showCategories')->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Función para eliminar una categoría
     */
    public function destroy($id)
    {
        $categoria = Category::findOrFail($id);
        $categoria->delete();

        return redirect()->route('showCategories')->with('success', 'Categoría eliminada correctamente.');
    }
}


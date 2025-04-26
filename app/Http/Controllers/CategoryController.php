<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categorias = Category::with('parent')->get();
        return view('showCategories', compact('categorias'));
    }

    public function create()
    {
        $categorias = Category::all(); // Para seleccionar padre si se desea
        return view('editCategory', compact('categorias'));
    }

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

    public function edit($id)
    {
        $categoria = Category::findOrFail($id);
        $categorias = Category::where('id', '!=', $id)->get(); // Para evitar que sea su propio padre
        return view('editCategory', compact('categoria', 'categorias'));
    }

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

    public function destroy($id)
    {
        $categoria = Category::findOrFail($id);
        $categoria->delete();

        return redirect()->route('showCategories')->with('success', 'Categoría eliminada correctamente.');
    }
}


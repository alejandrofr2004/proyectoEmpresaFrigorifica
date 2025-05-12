<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function index()
    {
        $productos = Product::all();
        return view('showProducts', compact('productos'));
    }
    public function showProduct(): View
    {
        // Traer todos los productos
        $productos = Product::inRandomOrder()->take(6)->get();

        // Traer las categorías padre con sus subcategorías
        $categoriasPadre = Category::with('children')->whereNull('padre_id')->take(3)->get();

        // Traer las subcategorías sin padre (Carnes, Verduras, etc.)
        $categoriasSinPadre = Category::whereNull('padre_id')->whereIn('nombre', ['Carnes', 'Verduras', 'Precocinados', 'Conservas'])->get();

        return view('index', [
            'productos' => $productos,
            'categoriasPadre' => $categoriasPadre,
            'categoriasSinPadre' => $categoriasSinPadre
        ]);
    }

    public function showByCategory($id)
    {
        // Buscar la categoría
        $categoria = Category::findOrFail($id);
        $nombreCategoria = $categoria->nombre;
        // Traer las categorías padre con sus subcategorías
        $categoriasPadre = Category::with('children')->whereNull('padre_id')->take(3)->get();

        // Traer las subcategorías sin padre (Carnes, Verduras, etc.)
        $categoriasSinPadre = Category::whereNull('padre_id')->whereIn('nombre', ['Carnes', 'Verduras', 'Precocinados', 'Conservas'])->get();
        // Si tiene subcategorías (es una categoría padre)
        if ($categoria->children()->exists()) {
            // Obtener los IDs de la categoría padre y sus hijos
            $idsCategorias = $categoria->children->pluck('id')->toArray();
            $idsCategorias[] = $categoria->id; // incluir también la categoría padre

            // Obtener los productos de esas categorías
            $productos = Product::whereIn('categoria_id', $idsCategorias)->get();
        } else {
            // Si no tiene hijos, solo mostrar los productos de esa categoría
            $productos = Product::where('categoria_id', $categoria->id)->get();
        }

        return view('index', [
            'productos' => $productos,
            'categoria' => $categoria,
            'nombreCategoria' => $nombreCategoria,
            'categoriasPadre' => $categoriasPadre,
            'categoriasSinPadre' => $categoriasSinPadre
        ]);
    }

    public function create()
    {
        $categorias = Category::all();
        return view('editProduct', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',

            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',

            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'imagen.max' => 'La imagen no debe superar los 2 MB.',

            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ]);

        $imagenPath = null;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $nombreFormateado = strtolower(str_replace(' ', '_', $request->nombre));
            $nombreImagen = $nombreFormateado . '.' . $extension;
            $imagen->move(public_path('img'), $nombreImagen);
            $imagenPath = 'img/' . $nombreImagen;
        }

        Product::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen_url' => $imagenPath,
            'categoria_id' => $request->categoria_id
        ]);

        return redirect()->route('showProducts')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $producto = Product::findOrFail($id);
        $categorias = Category::all();

        return view('editProduct', compact('producto', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $producto = Product::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',

            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',

            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',

            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'imagen.max' => 'La imagen no debe superar los 2 MB.',

            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ]);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $extension = $imagen->getClientOriginalExtension();
            $nombreFormateado = strtolower(str_replace(' ', '_', $request->nombre));
            $nombreImagen = $nombreFormateado . '.' . $extension;
            $imagen->move(public_path('img'), $nombreImagen);
            $producto->imagen_url = 'img/' . $nombreImagen;
        }

        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id
        ]);

        $producto->save();

        return redirect()->route('showProducts')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Product::findOrFail($id);
        $producto->delete();

        return redirect()->route('showProducts')->with('success', 'Producto eliminado correctamente.');
    }

}

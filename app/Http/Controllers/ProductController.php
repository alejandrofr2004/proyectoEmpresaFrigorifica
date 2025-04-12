<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function showProduct(): \Illuminate\View\View
    {
        // Traer todos los productos
        $productos = Product::all();

        // Traer las categorías padre con sus subcategorías
        $categoriasPadre = Category::with('children')->whereNull('padre_id')->take(3)->get();

        // Traer las subcategorías sin padre (Carnes, Verduras, etc.)
        $categoriasSinPadre = Category::whereNull('padre_id')->whereIn('nombre', ['Carnes', 'Verduras', 'Precocinados', 'Conservas'])->get();

        return view('index', [
            'productos' => $productos,
            'categoriasPadre' => $categoriasPadre,
            'categoriasSinPadre' => $categoriasSinPadre,
        ]);
    }

    public function showByCategory($id)
    {
        // Obtener la categoría por ID
        $categoria = Category::findOrFail($id);

        // Obtener los productos que pertenecen a esta categoría
        // Aquí puedes modificar según la relación en tu modelo Product
        $productos = Product::where('category_id', $categoria->id)->get();

        // Pasar los productos y la categoría a la vista
        return view('categoryProducts', [
            'productos' => $productos,
            'categoria' => $categoria
        ]);
    }
}

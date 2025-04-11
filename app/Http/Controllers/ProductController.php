<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function showProduct():View
    {
        // Obtener el producto con ID 1
        $productos = Product::all();

        // Pasar el producto a la vista
        return view('index', ['productos' => $productos]);
    }

    public function showByCategory(int $id): View
    {
        // Obtener productos que pertenecen a esa categoría o subcategoría
        $productos = Product::where('category_id', $id)->get();

        // Obtener el nombre de la categoría (si existe)
        $categoria = Category::find($id);

        return view('categoryProducts', [
            'productos' => $productos,
            'titulo' => $categoria ? $categoria->name : 'Productos'
        ]);
    }
}

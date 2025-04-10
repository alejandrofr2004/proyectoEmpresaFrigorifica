<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showProduct()
    {
        // Obtener el producto con ID 1
        $productos = Product::all();

        // Pasar el producto a la vista
        return view('categoryProducts', ['productos' => $productos]);
    }
}

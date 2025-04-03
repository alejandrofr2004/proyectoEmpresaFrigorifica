<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showProduct()
    {
        // Obtener el producto con ID 1
        $producto = Product::find(1);

        // Pasar el producto a la vista
        return view('index', ['producto' => $producto]);
    }
}

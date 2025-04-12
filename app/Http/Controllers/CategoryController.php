<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Muestra todas las categorías padre con sus subcategorías.
     */
    public function index(): \Illuminate\View\View
    {
        $categoriasPadre = Category::with('children')->whereNull('padre_id')->get();

        return view('index', compact('categoriasPadre'));
    }
}


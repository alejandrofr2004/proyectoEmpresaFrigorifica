<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    // Obtener el carrito del usuario desde la BD
    public function getCart()
    {
        $user = Auth::user();
        $cart = json_decode($user->cart, true) ?? [];
        return response()->json($cart);
    }

    // Actualizar el carrito del usuario en la BD
    public function updateCart(Request $request)
    {
        $user = Auth::user();
        $cart = json_decode($user->cart, true) ?? [];
        foreach ($request->all() as $productId => $data) {
            $producto = Product::find($productId);

            if ($producto) {
                if ($data['quantity'] > 0) {
                    $cart[$productId] = [
                        'nombre' => $producto->nombre,
                        'price' => $producto->precio,
                        'quantity' => $data['quantity'],
                        'image' => $producto->imagen_url
                    ];
                } else {
                    unset($cart[$productId]);
                }
            }
        }
        // Guardar el carrito en la BD del usuario
        $user->cart = json_encode($cart);
        $user->save();

        session()->put('cart', $cart);

        return response()->json(['message' => 'Carrito actualizado correctamente']);
    }

    // Mostrar el carrito en la vista
    public function showCart()
    {
        $user = Auth::user();
        $cart = json_decode($user->cart, true) ?? [];
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity'] * 1.21);

        // Traer las categorías padre con sus subcategorías
        $categoriasPadre = Category::with('children')->whereNull('padre_id')->take(3)->get();

        // Traer las subcategorías sin padre (Carnes, Verduras, etc.)
        $categoriasSinPadre = Category::whereNull('padre_id')->whereIn('nombre', ['Carnes', 'Verduras', 'Precocinados', 'Conservas'])->get();

        return view('shoppingCart', [
            'cart' => $cart,
            'categoriasPadre' => $categoriasPadre,
            'categoriasSinPadre' => $categoriasSinPadre,
            'total' => $total
        ]);
    }


    // Vaciar el carrito
    public function clearCart()
    {
        $user = Auth::user();
        $user->cart = json_encode([]);
        $user->save();

        session()->forget('cart');

        // Traer las categorías padre con sus subcategorías
        $categoriasPadre = Category::with('children')->whereNull('padre_id')->take(3)->get();

        // Traer las subcategorías sin padre (Carnes, Verduras, etc.)
        $categoriasSinPadre = Category::whereNull('padre_id')->whereIn('nombre', ['Carnes', 'Verduras', 'Precocinados', 'Conservas'])->get();

        return redirect()->route('index')->with([
            'success' => 'Carrito borrado correctamente.',
            'categoriasPadre' => $categoriasPadre,
            'categoriasSinPadre' => $categoriasSinPadre,
            'pedido_borrado' => 'Pedido borrado correctamente.'
        ]);


    }

}

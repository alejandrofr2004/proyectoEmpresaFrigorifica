<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Metodo para actualizar el carrito en la sesión
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

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
                    unset($cart[$productId]); // Eliminar si la cantidad es 0
                }
            }
        }

        session()->put('cart', $cart);
        return response()->json(['message' => 'Carrito actualizado correctamente']);
    }

    // Metodo para mostrar el carrito en la vista shoppingCart
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('shoppingCart', compact('cart'));
    }
}

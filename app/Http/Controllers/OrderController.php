<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = json_decode($user->cart, true);

        if (!$cart || empty($cart)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        // Buscar el cliente asociado al usuario
        $cliente = Client::where('user_id', $user->id)->first();
        if (!$cliente) {
            return redirect()->back()->with('error', 'No se encontró un cliente asociado a este usuario.');
        }

        // Crear el pedido con el cliente correcto
        $pedido = Order::create([
            'cliente_id' => $cliente->id,
            'total' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity'] * 1.21),
            'estado' => 'Pendiente'
        ]);

        // Guardar detalles del pedido y restar stock
        foreach ($cart as $productId => $item) {
            $producto = Product::find($productId);

            if ($producto && $producto->stock >= $item['quantity']) {
                // Restar stock
                $producto->stock -= $item['quantity'];
                $producto->save();

                // Guardar en detalle_pedidos
                OrderDetails::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $productId,
                    'cantidad' => $item['quantity'],
                    'precio' => $item['price'] * 1.21
                ]);
            } else {
                return redirect()->back()->with('error', "Stock insuficiente para {$producto->nombre}.");
            }
        }

        // Vaciar el carrito después de confirmar el pedido
        $user->cart = json_encode([]);
        $user->save();

        return redirect()->route('index')->with([
            'pedido_id' => $pedido->id,
            'success' => 'Pedido confirmado correctamente.',
            'pedido_completado' => 'Pedido registrado con éxito.',
            'fecha_recogida' => now()->addDays(2)->format('d/m/Y')
        ]);
    }

    public function factura(Order $pedido)
    {
        $pdf = Pdf::loadView('factura', compact('pedido'));
        return $pdf->download("factura_pedido_{$pedido->id}.pdf");
    }
}

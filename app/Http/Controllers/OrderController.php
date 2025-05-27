<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\Product;
use App\Models\Client;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Función para almacenar un nuevo pedido.
     * Verifica el carrito del usuario, crea el pedido,
     * guarda los detalles y descuenta stock.
     */
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
    session()->forget('cart');

    return redirect()->route('index')->with([
        'pedido_id' => $pedido->id,
        'success' => 'Pedido confirmado correctamente.',
        'pedido_completado' => 'Pedido registrado con éxito.',
        'fecha_recogida' => now()->addDays(2)->format('d/m/Y')
    ]);
}

    /**
     * Función para mostrar la lista de pedidos.
     */
    public function index()
    {
        $pedidos = Order::with('client')->get();
        return view('showOrders', compact('pedidos'));
    }

    /**
     * Función para eliminar un pedido por su ID.
     */
    public function destroy($id)
    {
        $pedido = Order::findOrFail($id);
        $pedido->delete();

        return redirect()->route('showOrders')->with('success', 'Pedido eliminado correctamente.');
    }

    /**
     * Generar y descargar la factura en PDF para un pedido específico.
     */
    public function factura($id)
    {
        // Busco el pedido por su ID y cargo sus detalles
        $pedido = Order::with('orderDetails.product')->findOrFail($id);

        // Genero el PDF usando la vista invoices.pdf y le paso el pedido como dato
        $pdf = PDF\Pdf::loadView('invoices.pdf', ['pedido' => $pedido]);

        // Descargo el PDF con el nombre "factura_idpedido.pdf"
        return $pdf->download('Factura_'.$pedido->id.'.pdf');
    }
}

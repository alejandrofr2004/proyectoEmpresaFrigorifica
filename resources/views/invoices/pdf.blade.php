<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; margin: 0 auto; }
        .header { text-align: center; font-size: 24px; font-weight: bold; }
        .details { margin-top: 20px; }
        .details th, .details td { padding: 5px; border: 1px solid black; }
        .total { margin-top: 10px; font-size: 18px; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">Factura #{{ $pedido->id }}</div>
    <p>Cliente: {{ Auth::user()->first_name }}</p>
    <p>Fecha: {{ $pedido->created_at->format('d/m/Y') }}</p>

    <table class="details">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
        @foreach ($pedido->orderDetails as $detalle)
            <tr>
                <td>{{ $detalle->product->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>€{{ number_format($detalle->precio, 2) }}</td>
                <td>€{{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
            </tr>
        @endforeach
    </table>

    <p class="total">Total a pagar: €{{ number_format($pedido->total, 2) }}</p>
</div>
</body>
</html>

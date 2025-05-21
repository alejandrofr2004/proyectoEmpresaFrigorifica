<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            font-size: 16px;
        }

        .factura-container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #ffffff;
            border: 2px solid #1e81b0;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .factura-header {
            background-color: #1e81b0;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            font-size: 26px;
            font-weight: bold;
        }

        .factura-info {
            margin-top: 20px;
            font-size: 18px;
        }

        .factura-info p {
            margin: 5px 0;
        }

        .factura-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .factura-table th {
            background-color: #76c7c0;
            color: white;
            padding: 12px;
            font-size: 18px;
        }

        .factura-table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .factura-total {
            text-align: right;
            margin-top: 25px;
            font-size: 20px;
            font-weight: bold;
            color: #1e81b0;
        }

        @media screen and (max-width: 600px) {
            .factura-container {
                padding: 20px;
            }

            .factura-table th,
            .factura-table td {
                font-size: 14px;
                padding: 8px;
            }

            .factura-header {
                font-size: 22px;
            }

            .factura-info {
                font-size: 16px;
            }

            .factura-total {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
<div class="factura-container">
    <div class="factura-header">
        Factura #{{ $pedido->id }}
    </div>

    <div class="factura-info">
        <p><strong>Cliente:</strong> {{ Auth::user()->first_name }}</p>
        <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y') }}</p>
    </div>

    <table class="factura-table">
        <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pedido->orderDetails as $detalle)
            <tr>
                <td>{{ $detalle->product->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>€{{ number_format($detalle->precio, 2) }}</td>
                <td>€{{ number_format($detalle->cantidad * $detalle->precio, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p class="factura-total">
        Total a pagar: €{{ number_format($pedido->total, 2) }}
    </p>
</div>
</body>
</html>

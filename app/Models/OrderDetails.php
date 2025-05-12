<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedidos';

    protected $fillable = [
        'pedido_id',
        'producto_id',
        'cantidad',
        'precio',
    ];

    // Relationship: An order detail belongs to an order (N:1)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship: An order detail belongs to a product (N:1)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}


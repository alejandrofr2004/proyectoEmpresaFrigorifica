<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'total',
        'estado',
    ];

    // Relationship: A pedido belongs to a customer (1:N)
    public function customer()
    {
        return $this->belongsTo(Client::class);
    }

    // Relationship: A pedido has many order details (1:N)
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
}

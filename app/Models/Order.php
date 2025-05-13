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
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'cliente_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'pedido_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}

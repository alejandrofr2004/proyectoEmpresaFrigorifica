<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional si sigue la convención Laravel)
    protected $table = 'clientes';

    // Campos asignables en masa
    protected $fillable = [
        'user_id',
        'telefono',
        'direccion',
    ];

    // Relación con el modelo User (1:1) (clave foránea)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

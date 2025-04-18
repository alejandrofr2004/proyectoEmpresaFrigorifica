<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Indicar la tabla si no sigue la convención
    protected $table = 'productos';

    // Permitir asignación masiva en estos campos
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'imagen_url'];
}

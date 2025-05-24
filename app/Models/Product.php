<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Laravel, por defecto, usa el nombre del modelo en plural para la tabla.
     * Como mi tabla ya se llama productos, especifico su nombre para evitar confusiones.
     */
    protected $table = 'productos';


    /**
     * Lista de atributos que pueden ser modificados juntos, sólo los editables
     */
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock', 'imagen_url'];
}

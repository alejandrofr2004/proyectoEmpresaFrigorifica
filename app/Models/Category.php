<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $fillable = ['nombre', 'imagen', 'padre_id'];

    public function children()
    {
        return $this->hasMany(Category::class, 'padre_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'padre_id');
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }
}

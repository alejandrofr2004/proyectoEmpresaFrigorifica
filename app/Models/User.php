<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * Lista de atributos que pueden ser modificados juntos, sólo los editables
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
    ];

    /**
     * Atributos ocultos cuando se serialice el modelo (como convertir a JSON), no aparecerán
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atributos que tienen que ser transformados automáticamente
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Redirigir a login si no está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Verificar si tiene el rol requerido
        if (!Auth::user()->hasRole($role)) {
            return response()->view('403', [], 403);
        }

        return $next($request);
    }
}

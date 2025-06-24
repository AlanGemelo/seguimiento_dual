<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario ha iniciado sesión
        if (Auth::check()) {
            // Obtener el usuario autenticado
            $user = Auth::user();
            
            // Verificar el tipo de usuario (por ejemplo, role_id == 1 para el administrador)
            if ($user->rol_id == 1|| $user->rol_id == 4 ||$user->rol_id == 2 ) {
                // Usuario administrador, continuar con la solicitud
                return $next($request);
            }
        }

        // Si no es un usuario administrador, redirigir al dashboard
        return redirect()->route('dashboard')->withErrors('No tienes permiso para acceder a esta página.');
    }
}

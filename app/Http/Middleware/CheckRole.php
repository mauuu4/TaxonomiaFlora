<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Verifica si el usuario está autenticado y tiene el rol necesario
        if (!Auth::check() || !Auth::user()->hasRole($role)) {
            return abort(403, 'Acceso denegado');
        }

        return $next($request);
    }
}

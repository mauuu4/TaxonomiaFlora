<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect('/')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        // Obtén el rol del usuario
        $userRole = Auth::user()->roles->tipus_detalles;

        // Permite el acceso si el rol del usuario está en la lista de roles válidos
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Si el rol no coincide, deniega el acceso
        return redirect('/')->with('error', 'No tienes permiso para acceder a esta sección.');
    }
}


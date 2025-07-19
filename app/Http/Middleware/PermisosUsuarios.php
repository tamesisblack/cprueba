<?php

namespace sisVentas\Http\Middleware;

use Closure;

class PermisosUsuarios
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$pagina = null)
    {

        if (!in_array($pagina,explode(',',auth()->user()->permisos_user->permisos)))
        {
            return redirect('/home');
        }


        return $next($request);
    }
}

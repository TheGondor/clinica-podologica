<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Activo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $usuario = \App\User::find(Auth::id());
            if($usuario){
                return $next($request);
            }
            else{
                abort(404);
            }
        }
        else{
            abort(404);
        }
    }
}

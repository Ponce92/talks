<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$reqPerm)
    {
//        $user=Auth::user();
//        foreach ($user->rol->permissions as $pivot){
//            if($reqPerm==$pivot->getName()){
//                return $next($request);
//            }
//        }
//
//        abort(401, 'No tienes accesso a esta accion.');
        return $next($request);
    }
}

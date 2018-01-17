<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        return $next($request);
//        if(Auth::check()){
//            if (Auth::user()->id>0){
//                return $next($request);
//            }else{
//                return redirect('error');
//            }
//        }else{
//            return redirect('error');
//        }




//        if (Auth::guard($guard)->check()) {
//            return redirect('/');
//        }


    }
}

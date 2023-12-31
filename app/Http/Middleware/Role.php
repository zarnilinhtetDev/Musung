<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class Role
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
        if (Auth::user()->role == 99) {
            return $next($request);
        }
        if (Auth::user()->role == 98) {
            return $next($request);
        }
        if (Auth::user()->role == 97) {
            return $next($request);
        }
        if (Auth::user()->role == 0) {
            return $next($request);
        }
        if (Auth::user()->role == 1) {
            return $next($request);
        }
        if (Auth::user()->role == 2) {
            return $next($request);
        }
        // if (Auth::user()->role == 3) {
        //     return $next($request);
        // }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!empty(Auth::user())){
            if (url()->current() == route('auth#loginPage') ||
             url()->current() == route('auth#registerPage') ||
             url()->current() == route('auth#/')) {
                return back();
            }

            if ( auth()->user()->role === 'admin' ) {
                return back();
            }
            return $next($request);
        }
        return $next($request);
    }
}

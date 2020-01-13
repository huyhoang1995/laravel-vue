<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class myAuth
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
        // return Session::get('accesToken');
        if (Session::get('accesToken')) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
        // return $next($request);
    }
}

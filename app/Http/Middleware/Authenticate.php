<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    /*protected function redirectTo($request)
    {
        if(! $request->expectsJson()){
           return view('/login');
        }
    }*/
    public function handleAuthenticatedRequest($request, Closure $next)
    {
        if(auth::check()) {
            return $next($request);
        }
        return redirect('/login');
    }
}

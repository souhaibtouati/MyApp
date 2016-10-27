<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class AdminMiddleware
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
        if (! Sentinel::getUser()){
            return redirect ('/login');
        }
        if (! Sentinel::hasAccess('admin')) {
            return redirect('/403');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(Auth::check())
        {
            if (!$request->user()->hasRole($role))
               return redirect()->route('no-access');

            return $next($request);
        }
        else
        {
            return redirect()->route('login');
        }
    }
}

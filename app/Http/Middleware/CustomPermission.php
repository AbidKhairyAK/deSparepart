<?php

namespace App\Http\Middleware;

use Closure;

class CustomPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        if (!$request->user()->can(explode('|', $permissions))) {
            return response()->view('errors.401');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class CheckSuperAdmin
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
        if(!$request->user()->hasRole('superadmin')){
            return redirect('/admin/user_settings');
        }

        return $next($request);
    }
}

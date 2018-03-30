<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
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
        \Menu::make('MyNavBar', function ($menu) {

            $links = \App\MenuLink::orderBy('order', 'asc')->get();

            foreach ($links as $link)
            {
                $temp = $menu->add($link->name, $link->link);
            }

        });
    
        return $next($request);
    }
}

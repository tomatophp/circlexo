<?php

namespace Modules\CircleXO\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('accounts')->user()){
            if(auth('accounts')->user()->meta('lang')){
                app()->setLocale(auth('accounts')->user()->meta('lang'));
            }
        }

        return $next($request);
    }
}

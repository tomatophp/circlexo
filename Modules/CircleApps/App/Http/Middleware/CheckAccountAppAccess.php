<?php

namespace Modules\CircleApps\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccountAppAccess
{

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $app)
    {
        if(auth('accounts')->user() && (!has_app($app))) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}

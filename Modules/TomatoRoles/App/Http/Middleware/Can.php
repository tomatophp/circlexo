<?php

namespace Modules\TomatoRoles\App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class Can extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if(auth()->user()){
            $checkPermEx = Permission::where('name', $request->route()->getName())->first();
            if((auth()->user()->can($request->route()->getName())) || (!$checkPermEx)){
                return $next($request);
            }
            else {
                return abort(403);
            }
        }
        else {
            return $next($request);
        }
    }
}

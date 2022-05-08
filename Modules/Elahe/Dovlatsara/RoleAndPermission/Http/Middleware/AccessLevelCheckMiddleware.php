<?php


namespace Modules\RoleAndPermission\Http\Middleware;

use Closure;

class AccessLevelCheckMiddleware
{
    public function handle($request, Closure $next)
    {
        if(!auth()->user()->hasRole('admin'))
        {
            return redirect()->route('master.index');
        }
        return $next($request);

    }
}

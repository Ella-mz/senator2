<?php


namespace Modules\HologramInterface\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Modules\HologramInterface\Entities\HologramInterface;

class RequestIsPending
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
        if (HologramInterface::find($request->hologram_interface_id)->status=='pending' &&
            HologramInterface::find($request->hologram_interface_id)->isPaid==1) {
            return $next($request);

        }
        return redirect()->back();

    }
}

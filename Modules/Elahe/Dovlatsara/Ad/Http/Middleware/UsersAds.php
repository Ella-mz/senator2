<?php


namespace Modules\Ad\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Modules\Ad\Entities\Ad;
use Modules\HologramInterface\Entities\HologramInterface;

class UsersAds
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
//        dd($request->user);
        if (Ad::find($request->user)->user_id==\auth()->id()) {
            return $next($request);

        }
        return redirect()->back();

    }
}

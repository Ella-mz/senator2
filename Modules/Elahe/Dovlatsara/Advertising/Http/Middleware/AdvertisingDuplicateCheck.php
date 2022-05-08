<?php


namespace Modules\Advertising\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Advertising\Entities\Advertising;

class AdvertisingDuplicateCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Advertising::where('advertising_order_id', $request->orderPage)->where('active', 1)->get()->count()<=0)
            return $next($request);
        alert()->error('','مکان تبلیغ تکراری است');
        return redirect()->back();
    }
}

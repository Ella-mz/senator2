<?php


namespace Modules\Ad\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StoreAd
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
//        dd($request->all(), \session('adParams'));
//        dd($request->session()->previousUrl(), $request->url());
        \session(['backUrl' => $request->url()]);
        \session(['backBackUrl' => $request->session()->previousUrl()]);
        if (! Auth::check()) {
            return redirect()->route('auth.loginForm.user');
        }
        return $next($request);
    }
}

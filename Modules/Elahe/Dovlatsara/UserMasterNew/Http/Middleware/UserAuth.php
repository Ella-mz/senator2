<?php


namespace Modules\UserMasterNew\Http\Middleware;

use Closure;

class UserAuth
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
        \session(['backUrl' => $request->url()]);
        \session(['backBackUrl' => $request->session()->previousUrl()]);
        if (! \auth()->check()) {
            return redirect()->route('auth.loginForm.user');
        }
        return $next($request);
    }
}

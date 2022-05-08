<?php


namespace Modules\AdminMaster\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
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
        if (! Auth::check()) {
            return redirect()->route('admin_login_form');
        }
//        if (\auth()->user()->shop_active != 'active'){
//            return redirect()->route('realestate_login_form')->with('mm', 'اجازه دسترسی به پنل را ندارید');
//        }
        return $next($request);
    }
}

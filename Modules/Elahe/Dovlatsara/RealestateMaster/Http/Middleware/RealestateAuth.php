<?php


namespace Modules\RealestateMaster\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class RealestateAuth
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
        if (! \auth()->check()) {
            return redirect()->route('realestate_login_form');
        }
        if (\auth()->user()->hasRole('real-state-administrator') && \auth()->user()->shop_active != 'active'){
            return redirect()->route('realestate_login_form')->with('mm', 'آژانس شما توسط ادمین تایید نشده است، اجازه دسترسی به پنل را ندارید');
        }
        if (\auth()->user()->hasRole('real-state-agent') && !isset(\auth()->user()->real_estate_admin_id)){
            return redirect()->route('realestate_login_form')->with('mm', 'درحال حاضر زیرمجموعه هیچ کسب و کاری نیستید');
        }
        return $next($request);
    }
}

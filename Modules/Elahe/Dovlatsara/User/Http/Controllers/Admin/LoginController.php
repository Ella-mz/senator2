<?php

namespace Modules\User\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Modules\Setting\Entities\Setting;
use Modules\User\Http\Requests\Admin\auth\LoginRequest;
use Modules\User\Entities\User;

class LoginController extends Controller
{

    public function loginForm()
    {
        $logo = Setting::where('title', 'bright_logo_of_site')->first()->str_value;
        $title_of_site = Setting::where('title', 'title_of_site')->first()->str_value;
        return view('Users::admin.auth.loginForm', compact('title_of_site', 'logo'));
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('mobile',$request->mobile)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
//                $admin = $user->hasRole('user');
//                if ($user->hasRole('admin') || $user->hasRole('operator')) {
                Auth::loginUsingId($user->id);
                return view('AdminMasterNew::index');

//                return redirect()->route('adminMaster123');
//                } else {
//                    return back()->with('message', 'اجازه ورود ندارید.');
//                }
            } else {
                return back()->with('message', 'کلمه عبور اشتباه است.');
            }
        } else {
            return back()->with('message', 'اکانتی با این شماره موبایل فعال نمی باشد.');
        }
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('admin_login');
    }
}

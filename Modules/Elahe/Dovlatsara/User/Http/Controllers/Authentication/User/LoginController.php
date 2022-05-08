<?php

namespace Modules\User\Http\Controllers\Authentication\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\Authentication\User\LoginOTPRequest;
use Modules\User\Http\Requests\Authentication\User\LoginRequest;
use Modules\User\Http\Requests\Authentication\User\VerifyRequest;

class LoginController extends Controller
{

    public function loginForm(Request $request)
    {
        $previousUrl = $request->session()->previousUrl();
        $logo = Setting::where('title', 'bright_logo_of_site')->first()->str_value;

        return view('Users::auth.user.loginForm', compact('logo', 'previousUrl'));
    }

    public function loginOTP(LoginOTPRequest $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
//        $login_user = null;
//        foreach ($users as $user){
//            if ($user->hasRole('ordinary-user'))
//                $login_user = $user;
//        }
        if ($user) {
            //sms
            $code = mt_rand(1000, 9999);
//            $code = 1234;
            DB::table('verification')->insert([
                'mobile' => $request->mobile,
                'code' => $code,
                'created_at' => Carbon::now(),
            ]);
            try {
                app('Modules\SMS\Http\Controllers\SMSController')
                    ->send_sms_with_pattern($user->mobile, null, $code, 53372, $user, 'VerificationCode');
            }catch (\Exception $e){
                return redirect()->back();
            }
            $logo = Setting::where('title', 'bright_logo_of_site')->first()->str_value;
            $previousUrl = $request->previousUrl;

            return view('Users::auth.user.verifyForm', compact('user', 'logo', 'previousUrl'));

//            return redirect(route('auth.verifyForm.user', $login_user->id));

        } else {
            return back()->with('messageOTP', 'لطفا برای ورود به سایت ثبت نام کنید.');
        }
    }

    public function verifyForm(User $user)
    {
        $logo = Setting::where('title', 'bright_logo_of_site')->first()->str_value;

        return view('Users::auth.user.verifyForm', compact('user', 'logo'));
    }

    public function verify(VerifyRequest $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
        if ($user) {
            $verfication = DB::table('verification')
                ->where('mobile', $request->mobile)
                ->orderByDesc('created_at')->first();

            if ($verfication->code == $request->verification_code) {
                Auth::loginUsingId($user->id);
                if (strpos($request->previousUrl, 'bookmarked') && \session('backBackUrl'))
                    return redirect(\url(\session('backBackUrl')));
                if (\session('backUrl'))
                    return redirect(\url(\session('backUrl')));
                else
                    return redirect()->route('homePage.user');

            } else {
                return redirect()->back()->with('message', 'کد تایید اشتباه است.');
            }
        } else {
            return redirect()->back()->with('message', 'شماره موبایل وجود ندارد دوباره تلاش کنید.');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('homePage.user');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('mobile',$request->mobile_login)->first();
        if ($user) {
            if (Hash::check($request->password_login, $user->password)) {
                Auth::loginUsingId($user->id);
                if (strpos($request->previousUrl, 'bookmarked') && \session('backBackUrl'))
                    return redirect(\url(\session('backBackUrl')));
                if (\session('backUrl'))
                    return redirect(\url(\session('backUrl')));
                else
                    return redirect()->route('homePage.user');

            } else {
                return back()->with('messageLogin', 'کلمه عبور اشتباه است.');
            }
        } else {
            return back()->with('messageLogin', 'برای ورود به سایت ثبت نام فرمایید.');
        }
    }
}

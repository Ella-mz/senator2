<?php

namespace Modules\User\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\Authentication\User\VerifyRequest;
use Modules\User\Http\Requests\Realestate\auth\LoginOTPRequest;
use Modules\User\Http\Requests\Realestate\auth\LoginRequest;

class LoginController extends Controller
{

    public function loginForm()
    {
        return view('Users::realestate.auth.loginForm');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::loginUsingId($user->id);
                return redirect()->route('user.profile.realestate', $user->id);
            } else {
                return back()->with('message', 'کلمه عبور اشتباه است.');
            }
        } else {
            return back()->with('message', 'شماره موبایل شما وجود ندارد، برای ورود ثبت نام نمایید.');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('realestate_login_form');
    }

    /**
     * @param LoginOTPRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function loginOTP(LoginOTPRequest $request)
    {
        $user = User::where('mobile', $request->OTP_mobile)->first();
        if ($user) {
//            $code = mt_rand(1000, 9999);
            $code = 1234;
            DB::table('verification')->insert([
                'mobile' => $request->OTP_mobile,
                'code' => $code,
                'created_at' => Carbon::now(),
            ]);
            try {
                app('Modules\SMS\Http\Controllers\SMSController')
                    ->send_sms_with_pattern($user->mobile, null, $code, 53372, $user, 'VerificationCode');
            } catch (\Exception $e) {
                return back()->with('message_OTP', 'امکان ارسال sms وجود ندارد.');
            }
            $logo = Setting::where('title', 'bright_logo_of_site')->first()->str_value;

            return view('Users::realestate.auth.verifyForm', compact('user', 'logo'));
        } else {
            return back()->with('message_OTP', 'شماره موبایل شما وجود ندارد، برای ورود ثبت نام نمایید.');
        }
    }

    public function verifyForm(User $user)
    {
        $logo = Setting::where('title', 'bright_logo_of_site')->first()->str_value;

        return view('Users::realestate.auth.verifyForm', compact('user', 'logo'));
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
                return redirect()->route('user.profile.realestate', $user->id);

            } else {
                return back()->with('message', 'کد تایید اشتباه است.');
            }
        } else {
            return back()->with('message', 'شماره موبایل وجود ندارد دوباره تلاش کنید.');
        }
    }

}

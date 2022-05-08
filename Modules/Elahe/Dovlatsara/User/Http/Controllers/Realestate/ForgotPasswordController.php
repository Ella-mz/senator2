<?php

namespace Modules\User\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Ipecompany\Smsirlaravel\Smsirlaravel;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\Realestate\auth\LoginRequest;

class ForgotPasswordController extends Controller
{

    public function form()
    {
        $logo = Setting::where('title', 'bright_logo_of_site')->first()->str_value;
        return view('Users::realestate.forgotPassword.mobileForm', compact('logo'));
    }

    public function mobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'role' => 'required',
            'mobile' => 'required|iran_mobile'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::where('mobile', $request->mobile)->first();
//        $login_user = null;
//        foreach ($users as $user) {
//            if ($user->hasRole($request->role))
//                $login_user = $user;
//        }
        if ($user) {
            $code = mt_rand(1000, 9999);
//            $code = 1234;
            DB::table('verification')->insert([
                'mobile' => $request->mobile,
                'code' => $code,
                'created_at' => Carbon::now(),
            ]);
            //sms
            try {

                app('Modules\SMS\Http\Controllers\SMSController')
                    ->send_sms_with_pattern($request->mobile, null, $code, 53372, null, 'VerificationCode');
            } catch (\Exception $e) {
                return redirect()->back();

            }
            $logo = Setting::where('title', 'logo_of_site')->first()->str_value;

            return view('Users::realestate.forgotPassword.verifyForm', compact('user', 'logo'));

        } else {
            return back()->with('message', 'موبایل شما با این نقش در سامانه ثبت نشده است، برای عملیات مربوطه ثبت نام نمایید.');
        }
    }

    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'verification_code' => 'required',
            'mobile' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::where('mobile', $request->mobile)->first();
        $logo = Setting::where('title', 'bright_logo_of_site')->first()->str_value;
        $verfication = DB::table('verification')
            ->where('mobile', $user->mobile)
            ->orderByDesc('created_at')->first();
        if ($this->convertToEnglish($request->verification_code) == $verfication->code) {

            return view('Users::realestate.forgotPassword.password', compact('user', 'logo'));

        } else {
            return back()->with('message', 'کد تایید وارد شده اشتباه است.');
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'confirm_password' => 'required',
            'mobile' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errorValidation' => $validator->errors()->all(),
                '</br>'
            ]);
        }
        $user = User::where('mobile', $request->mobile)->first();
        if ($this->convertToEnglish($request->password) == $this->convertToEnglish($request->confirm_password)) {
            $user->update([
                'password' => bcrypt($this->convertToEnglish($request->password))
            ]);
//            Smsirlaravel::ultraFastSend(['username' => $user->userName], 55471, $request->mobile);

            app('Modules\SMS\Http\Controllers\SMSController')
                ->send_sms_with_pattern($request->mobile, null, $user->userName, 55471, null, 'username');
            return response()->json([
                'success' => '<div class="alert alert-success"  style="font-size: small">ویرایش با موفقیت انجام شد</div>',
            ]);

        } else {
            return response()->json([
                'errorValidation' => '<small class="text-danger">تکرار رمز عبور اشتباه است</small>',
            ]);
        }
    }

}

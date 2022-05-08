<?php

namespace Modules\User\Http\Controllers\Authentication\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Repositories\CityRepository;
use Modules\CostumerClub\Http\Controllers\Score\ScoreController;
use Modules\CostumerClub\Repositories\InviteRepository;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\Authentication\User\RegisterRequest;
use Modules\User\Repositories\UserRepository;

class RegisterController extends Controller
{
    private $categoryRepository;
    private $cityRepository;
    private $settingRepository;
    private $userRepository;
    private $inviteRepository;
    private $scoreController;

    public function __construct(CategoryRepository $categoryRepository, CityRepository $cityRepository,
                                SettingRepository $settingRepository, UserRepository $userRepository,
                                InviteRepository $inviteRepository, ScoreController $scoreController)
    {
        $this->categoryRepository = $categoryRepository;
        $this->cityRepository = $cityRepository;
        $this->settingRepository = $settingRepository;
        $this->userRepository = $userRepository;
        $this->inviteRepository = $inviteRepository;
        $this->scoreController = $scoreController;
    }

    public function register(RegisterRequest $request)
    {
        if (($request->password == $request->confirm_password)) {
//            $users = User::where('mobile', $request->register_mobile)->get();
//            $reg_user = null;
//            foreach ($users as $user) {
//                if ($user->hasRole('ordinary-user'))
//                    $reg_user = $user;
//            }
//            if ($reg_user) {
//                alert()->error('', 'قبلا با این شماره ثبت نام نموده اید');
//                return redirect()->back();
//
//            }
//            dd($request->all());
            $user = User::create([
                'mobile' => $request->register_mobile,
                'password' => bcrypt($request->password),
                'active' => 'active'
            ]);
            $uniqueCode = $user->id + 10000;

            $user->update(['user_id' => $uniqueCode]);
            $user->roles()->sync(Role::where('slug', 'ordinary-user')
                ->first()->id);
            $user->generateInvitedCode();
            if (isset($request->register_invitedCode)) {
                $invited_by = $this->userRepository->find_with_invited_code($request->register_invitedCode);
                if ($invited_by) {
                    $this->inviteRepository->create($user, $invited_by);
                    $this->scoreController->create_transaction_score('invite-caller-user', $invited_by->id, 'کسب امتیاز به دلیل دعوت دوستان');
                    $this->scoreController->create_transaction_score('invite-new-user', $user->id, 'کسب امتیاز جهت ورود کد معرف');
                }
            }
            $code = mt_rand(1000, 9999);
//            $code=1234;
            DB::table('verification')->insert([
                'mobile' => $request->register_mobile,
                'code' => $code,
                'created_at' => Carbon::now(),
            ]);
            //sms
            try {
                app('Modules\SMS\Http\Controllers\SMSController')
                    ->send_sms_with_pattern($user->mobile, null, $code, 45633, $user, 'VerificationCode');
            } catch (\Exception $e) {
                return redirect()->back();
            }

            $logo = Setting::where('title', 'bright_logo_of_site')->first()->str_value;
            $previousUrl = $request->previousUrl;
            return view('Users::auth.user.verifyForm', compact('user', 'logo', 'previousUrl'));
        } else
            return back()->with('message2', 'رمز عبور و تکرار رمز عبور باید مانند هم باشند.');
    }

}

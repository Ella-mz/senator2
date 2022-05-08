<?php

namespace Modules\User\Http\Controllers\Authentication\realEstateAdmin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Entities\City;
use Modules\City\Repositories\CityRepository;
use Modules\CostumerClub\Http\Controllers\Score\ScoreController;
use Modules\CostumerClub\Repositories\InviteRepository;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Entities\Level2CategoryOfAgency;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\Authentication\realEstateAdmin\AdminRegisterRequest;
use Modules\User\Http\Requests\Authentication\realEstateAdmin\AgentRegisterRequest;
use Modules\User\Http\Requests\Authentication\realEstateAdmin\ContractorRegisterRequest;
use Modules\User\Repositories\UserRepository;
use Modules\AdminMasterNew\Http\Traits;


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

    use Traits\UploadFileTrait;

    public function registerForm()
    {
        $user = null;
        $user_id = request('user');
        if (isset($user_id)) {
            if (auth()->user() && auth()->user()->hasRole('ordinary-user') && auth()->user()->user_id == $user_id) {
                $user = $this->userRepository->userFindByUserId($user_id);
            }
        }
        $logo = $this->settingRepository->getSettingByTitle('logo_of_site')->str_value;
        $cities = $this->cityRepository->all();
        $categories = $this->categoryRepository->categoryDepth1();
        $text_of_register = $this->settingRepository->getSettingByTitle('message_of_business_manager_register');
        $title_of_site = $this->settingRepository->getSettingByTitle('title_of_site');

        return view('Users::auth.realEstateAdmin&indepentAgent&contractor.registerForm4',
            compact('logo', 'cities', 'categories', 'user', 'text_of_register', 'user_id', 'title_of_site'));
    }

    /**
     * @param AdminRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerAdmin(AdminRegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user_id = $request->user;
        if (isset($user_id)) {
            if (auth()->user() && auth()->user()->hasRole('ordinary-user')
                && auth()->user()->user_id == $user_id) {
                $user = $this->userRepository->userFindByUserId($user_id);
                if ($user->id != $request->user_id)
                    return redirect()->back()->withInput();
            } else {
                return redirect()->back()->withInput();
            }
        }
        $reg_user = User::where('mobile', $request->admin_mobile)->first();
//        $reg_user = null;
//        foreach ($users as $user) {
//            if ($user->hasRole('real-state-administrator'))
//                $reg_user = $user;
//        }
//        if ($reg_user) {
//            alert()->error('', 'قبلا با این شماره ثبت نام نموده اید');
//            return redirect()->back()->withInput();
//        }
        if (($request->password == $request->confirm_password)) {

            $verfication = DB::table('verification')
                ->where('mobile', $request->admin_mobile)
                ->orderByDesc('created_at')->first();
            if ($reg_user) {
                $reg_user->update([
                    'name' => $request->admin_name,
                    'sirName' => $request->admin_sirName,
//                    'userName' => $request->admin_userName,
                    'email' => $request->admin_email,
                    'mobile' => $request->admin_mobile,
                    'password' => bcrypt($request->admin_password),
                    'shop_title' => $request->admin_shop_title,
                    'shop_website' => $request->admin_shop_website,
                    'input_slug' => $request->admin_slug,
//                    'userImage' => $userImage,
//                    'nationalCardImage' => $nationalCardImage,
//                    'mobasherCardImage' => $mobasherCardImage,
//                    'businessLicenseImage' => $businessLicenseImage,
//                    'shop_logo' => $logo,
                    'shop_city_id' => $request->admin_shop_city,
                    'shop_neighborhood_id' => $request->neighborhood,
                    'category_id' => $request->category,
                    'shop_phone' => $request->shopPhone,
                    'change_to_manager' => 1
                ]);
                if (isset($request->subCategory))
                    foreach ($request->subCategory as $subCat) {
                        Level2CategoryOfAgency::create([
                            'user_id' => $user->id,
                            'category_id' => $subCat
                        ]);
                    }
                if (isset($request->admin_invitedCode)) {
                    $invited_by = $this->userRepository->find_with_invited_code($request->admin_invitedCode);
                    if ($invited_by) {
                        $this->inviteRepository->create($user, $invited_by);
                        $this->scoreController->create_transaction_score('invite-caller-user', $invited_by->id, 'کسب امتیاز به دلیل دعوت دوستان');
                        $this->scoreController->create_transaction_score('invite-new-user', $user->id, 'کسب امتیاز جهت ورود کد معرف');
                    }
                }
                \alert()->success('', 'اطلاعات شما با موفقیت تکمیل شد، منتظر تایید ادمین بمانید.');
                return redirect()->route('user.profile.realestate', $user->id);
            } else {
                if (($request->admin_verifyCode == $verfication->code)) {
//                if ($request->file('admin_userImage')) {
//                    $userImage = $this->uploadFile($request->file('admin_userImage'), 'public/upload/user/userImage/' . now()->year
//                        . '/' . now()->month);
//                } else
//                    $userImage = null;
//                if ($request->file('admin_national_card_image')) {
//                    $nationalCardImage = $this->uploadFile($request->file('admin_national_card_image'), 'public/upload/user/nationalCardImage/' . now()->year
//                        . '/' . now()->month);
//                } else
//                    $nationalCardImage = null;
//                if ($request->file('admin_mobasher_card_image')) {
//                    $mobasherCardImage = $this->uploadFile($request->file('admin_mobasher_card_image'), 'public/upload/user/mobasherCardImage/' . now()->year
//                        . '/' . now()->month);
//                } else
//                    $mobasherCardImage = null;
//                if ($request->file('admin_business_license_card_image')) {
//                    $businessLicenseImage = $this->uploadFile($request->file('admin_business_license_card_image'), 'public/upload/user/businessLicenseImage/' . now()->year
//                        . '/' . now()->month);
//                } else
//                    $businessLicenseImage = null;
//                if ($request->file('admin_logo')) {
//                    $logo = $this->uploadFile($request->file('admin_logo'), 'public/upload/user/logo/' . now()->year
//                        . '/' . now()->month);
//                } else
//                    $logo = null;

                    $user = User::create([
                        'name' => $request->admin_name,
                        'sirName' => $request->admin_sirName,
//                    'userName' => $request->admin_userName,
                        'email' => $request->admin_email,
                        'mobile' => $request->admin_mobile,
                        'password' => bcrypt($request->admin_password),
                        'shop_title' => $request->admin_shop_title,
                        'shop_website' => $request->admin_shop_website,
                        'input_slug' => $request->admin_slug,
//                    'userImage' => $userImage,
//                    'nationalCardImage' => $nationalCardImage,
//                    'mobasherCardImage' => $mobasherCardImage,
//                    'businessLicenseImage' => $businessLicenseImage,
//                    'shop_logo' => $logo,
                        'shop_city_id' => $request->admin_shop_city,
                        'shop_neighborhood_id' => $request->neighborhood,
                        'category_id' => $request->category,
                        'shop_phone' => $request->shopPhone,
                        'change_to_manager' => 1,
                        'shop_active' => 'inactive'
                    ]);
                    $uniqueCode = $user->id + 10000;
                    $user->update(['user_id' => $uniqueCode]);
                    $user->roles()->sync(Role::where('slug', 'ordinary-user')->first()->id);
                    $user->generateInvitedCode();
                    foreach ($request->subCategory as $subCat) {
                        Level2CategoryOfAgency::create([
                            'user_id' => $user->id,
                            'category_id' => $subCat
                        ]);
                    }
                    if (isset($request->admin_invitedCode)) {
                        $invited_by = $this->userRepository->find_with_invited_code($request->admin_invitedCode);
                        if ($invited_by) {
                            $this->inviteRepository->create($user, $invited_by);
                            $this->scoreController->create_transaction_score('invite-caller-user', $invited_by->id, 'کسب امتیاز به دلیل دعوت دوستان');
                            $this->scoreController->create_transaction_score('invite-new-user', $user->id, 'کسب امتیاز جهت ورود کد معرف');
                        }
                    }
                    \alert()->success('', 'ثبت نام شما با موفقیت انجام شد، منتظر تایید ادمین بمانید.');
                    return redirect()->route('user.profile.realestate', $user->id);
                } else
                    return back()->with('message1', 'کد تایید اشتباه است.')->withInput();
            }

        } else {
            return back()->with('message2', 'تکرار رمز عبور اشتباه است.')->withInput();
        }
    }

    public function validateSlug(Request $request)
    {
//        if ($request->slug == null)
//            return response()->json([
//                'data' => [],
//                'errors' => ['حساب کاربری خود را وارد کنید.'],
//                'status_code' => 403,
//            ]);
        $validator = Validator::make($request->all(), [
            'slug' => 'required|is_not_persian',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status_code' => 403,
            ]);
        }
        if (User::where('input_slug', $request->slug)->orWhere('slug', $request->slug)->first())
            return response()->json([
                'data' => [],
                'errors' => ['حساب کاربری وارد شده قبلا انتخاب شده است.'],
                'status_code' => 403,
            ]);
        $createSlug = $this->createSlug($request->slug);
        if (User::where('input_slug', $createSlug)->orWhere('slug', $createSlug)->first())
            return response()->json([
                'data' => [],
                'errors' => ['حساب کاربری وارد شده قبلا انتخاب شده است.'],
                'status_code' => 403,
            ]);

        return response()->json(['slug' => $this->createSlug($request->slug)]);
    }

    public static function createSlug($str, $delimiter = '-')
    {

        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $slug;

    }

    /**
     * @param ContractorRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RegisterContractor(ContractorRegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        $users = $this->userRepository->usersGetByMobile($request->mobile);
        $reg_user = null;
        foreach ($users as $user) {
            if ($user->hasRole('contractor'))
                $reg_user = $user;
        }
        if ($reg_user) {
            alert()->error('', 'قبلا با این شماره ثبت نام نموده اید');
            return redirect()->back();
        }
        if (($request->password == $request->confirm_password)) {

            $verfication = DB::table('verification')
                ->where('mobile', $request->contractor_mobile)->orderByDesc('created_at')->first();
            if ($request->contractor_verifyCode == $verfication->code) {
                if ($request->file('contractor_userImage')) {
                    $userImage = $this->uploadFile($request->file('contractor_userImage'), 'public/upload/user/userImage/' . now()->year
                        . '/' . now()->month);
                } else
                    $userImage = null;
                if ($request->file('contractor_national_card_image')) {
                    $nationalCardImage = $this->uploadFile($request->file('contractor_national_card_image'), 'public/upload/user/nationalCardImage/' . now()->year
                        . '/' . now()->month);
                } else
                    $nationalCardImage = null;
                $user = User::create([
                    'name' => $request->contractor_name,
                    'sirName' => $request->contractor_sirName,
                    'userName' => $request->contractor_userName,
                    'email' => $request->contractor_email,
                    'mobile' => $request->contractor_mobile,
                    'password' => bcrypt($request->contractor_password),
                    'input_slug' => $request->contractor_slug,
                    'userImage' => $userImage,
                    'nationalCardImage' => $nationalCardImage,
                ]);
                $uniqueCode = $user->id + 10000;
                $user->update(['user_id' => $uniqueCode]);
                $user->roles()->sync(Role::where('slug', 'contractor')->first()->id);
                $user->generateInvitedCode();
                if (isset($request->contractor_invitedCode)) {
                    $invited_by = $this->userRepository->find_with_invited_code($request->contractor_invitedCode);
                    if ($invited_by) {
                        $this->inviteRepository->create($user, $invited_by);
                        $this->scoreController->create_transaction_score('invite-caller-user', $invited_by->id, 'کسب امتیاز به دلیل دعوت دوستان');
                        $this->scoreController->create_transaction_score('invite-new-user', $user->id, 'کسب امتیاز جهت ورود کد معرف');
                    }
                }
                \alert()->success('', 'ثبت نام شما با موفقیت انجام شد، منتظر تایید ادمین بمانید.');
                return redirect()->route('homePage.user');
            } else
                return back()->with('message3', 'کد تایید اشتباه است.')->withInput();

        } else {
            return back()->with('message4', 'تکرار رمز عبور اشتباه است.')->withInput();
        }
    }

    /**
     * @param AgentRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function RegisterAgent(AgentRegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        $users = $this->userRepository->usersGetByMobile($request->mobile);
        $reg_user = null;
        foreach ($users as $user) {
            if ($user->hasRole('independent-agent'))
                $reg_user = $user;
        }
        if ($reg_user) {
            alert()->error('', 'قبلا با این شماره ثبت نام نموده اید');
            return redirect()->back();
        }
        if (($request->password == $request->confirm_password)) {

            $verfication = DB::table('verification')->where('mobile', $request->agent_mobile)->orderByDesc('created_at')->first();
            if ($request->agent_verifyCode == $verfication->code) {
                if ($request->file('agent_userImage')) {
                    $userImage = $this->uploadFile($request->file('agent_userImage'), 'public/upload/user/userImage/' . now()->year
                        . '/' . now()->month);
                } else
                    $userImage = null;
                if ($request->file('agent_national_card_image')) {
                    $nationalCardImage = $this->uploadFile($request->file('agent_national_card_image'), 'public/upload/user/nationalCardImage/' . now()->year
                        . '/' . now()->month);
                } else
                    $nationalCardImage = null;
                $user = User::create([
                    'name' => $request->agent_name,
                    'sirName' => $request->agent_sirName,
                    'userName' => $request->agent_userName,
                    'email' => $request->agent_email,
                    'mobile' => $request->agent_mobile,
                    'password' => bcrypt($request->agent_password),
                    'input_slug' => $request->agent_slug,
                    'userImage' => $userImage,
                    'nationalCardImage' => $nationalCardImage,
                ]);
                $uniqueCode = $user->id + 10000;
                $user->update(['user_id' => $uniqueCode]);
                $user->roles()->sync(Role::where('slug', 'independent-agent')->first()->id);
                $user->generateInvitedCode();
                if (isset($request->agent_invitedCode)) {
                    $invited_by = $this->userRepository->find_with_invited_code($request->agent_invitedCode);
                    if ($invited_by) {
                        $this->inviteRepository->create($user, $invited_by);
                        $this->scoreController->create_transaction_score('invite-caller-user', $invited_by->id, 'کسب امتیاز به دلیل دعوت دوستان');
                        $this->scoreController->create_transaction_score('invite-new-user', $user->id, 'کسب امتیاز جهت ورود کد معرف');
                    }
                }
                \alert()->success('', 'ثبت نام شما با موفقیت انجام شد، منتظر تایید ادمین بمانید.');
                return redirect()->route('homePage.user');
            } else
                return back()->with('message5', 'کد تایید اشتباه است.')->withInput();

        } else {
            return back()->with('message6', 'تکرار رمز عبور اشتباه است.')->withInput();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setVerifyCode(Request $request): \Illuminate\Http\JsonResponse
    {
        if (isset($request->mobile)) {
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
                    ->send_sms_with_pattern($request->mobile, null, $code, 45633, null, 'VerificationCode');
            } catch (\Exception $e) {
                return redirect()->back();
            }

            return response()->json(['content' => 'کد تایید ارسال شد.']);
        } else
            return response()->json(['errors' => 'فیلد تلفن همراه الزامی است.']);

    }


    public function neighborhoodOld(Request $request)
    {
        $city = City::find($request->cityId);
        $neighborhood = Neighborhood::find($request->neighborhoodId);
        $content = '';
        $content .= '<label class="register-box-label">محله</label><div class="registerInputBox">';
        $content .= '<select class="registerselectbox select2" name="neighborhood" id="neighborhood" dir="rtl">';
        foreach ($city->neighborhoods as $neighbor) {
            if ($neighbor->id == $neighborhood->id) {
                $content .= '<option value="' . $neighbor->id . '" selected>' . $neighbor->title . '</option>';
            } else
                $content .= '<option value="' . $neighbor->id . '">' . $neighbor->title . '</option>';
        }
        $content .= '</select><br></div>';
        return json_encode(['content' => $content]);
    }

//    public function subCategoryOld(Request $request)
//    {
//        $category = $this->categoryRepository->categoryFindById($request->categoryId);
////        $subCategories = $this->categoryRepository->categoryFindByIds($request->subCategoryIds);
//        $content = '';
//        $content .= '<label class="register-box-label">حوزه های فعالیت</label>';
//        $content .= '<select class="registerselectbox select2" name="subCategory[]" multiple="multiple" dir="rtl" style="border: 1px solid #535353; width: 100%;">';
//        foreach ($category->subCategories as $cat) {
//
//                $content .= '<option value="' . $cat->id . '">' . $cat->title . '</option>';
//        }
//        $content .= '</select><br></div>';
//        return json_encode(['content' => $content]);
//    }

}

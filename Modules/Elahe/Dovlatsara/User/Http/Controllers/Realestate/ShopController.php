<?php

namespace Modules\User\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\Category\Entities\Category;
use Modules\City\Entities\City;
use Modules\CostumerClub\Http\Controllers\Score\ScoreController;
use Modules\CostumerClub\Repositories\InviteRepository;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\RoleAndPermission\Entities\Role;
use Modules\User\Entities\Level2CategoryOfAgency;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\Realestate\Shop\AgentStoreRequest;
use Modules\User\Http\Requests\Realestate\Shop\UpdateRequest;
use Modules\User\Repositories\UserRepository;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\AdminMasterNew\Http\Traits;

class ShopController extends Controller
{
    use Traits\UploadFileTrait;

    private $userRepository;
    private $inviteRepository;
    private $scoreController;

    public function __construct(UserRepository $userRepository,  InviteRepository $inviteRepository, ScoreController $scoreController)
    {
        $this->userRepository = $userRepository;
        $this->inviteRepository = $inviteRepository;
        $this->scoreController = $scoreController;
    }

    public function index(User $user)
    {
        return view('Users::realestate.shop.index', compact('user'));

    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $cities = City::all();
        $neighborhoods = Neighborhood::where('city_id', $user->shop_city_id)->get();
        $categories = Category::where('depth', 1)->get();
        $userCategory = Category::find($user->category_id);
        return view('Users::realestate.shop.edit', compact('user', 'cities', 'neighborhoods', 'categories', 'userCategory'));
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateRequest $request, User $user)
    {
        if ($request->file('logo')) {
            $logo = $this->uploadFile($request->file('logo'), 'public/upload/shop/logo/' . now()->year
                . '/' . now()->month);
        } else
            $logo = $user->shop_logo;
        if ($request->file('header_image')) {
            $header_image = $this->uploadFile($request->file('header_image'), 'public/upload/shop/header_image/' . now()->year
                . '/' . now()->month);
        } else
            $header_image = $user->shop_header_image;
        if ($request->slug != $user->slug) {
            $user->slug = null;
            $user->save();
        }
        $user->update([
            'shop_title' => $request->name,
            'shop_city_id' => $request->city,
            'shop_neighborhood_id' => $request->neighborhood,
            'shop_phone' => $request->phone,
            'yearOfOperation' => $request->yearOfOperation,
            'shop_address' => $request->address,
            'input_slug' => $request->slug,
            'shop_description' => $request->description,
            'shop_website' => $request->website,
            'shop_logo' => $logo,
            'category_id' => $request->category,
            'shop_header_title' => $request->header_title,
            'shop_header_image' => $header_image,
        ]);
        foreach ($user->level2CategoryOfAgencies as $subCategory)
            $subCategory->delete();

        foreach ($request->subCategory as $subCat){
            Level2CategoryOfAgency::create([
                'user_id'=>$user->id,
                'category_id' => $subCat
            ]);
        }

        if (isset($request->city_in_activity_range)) {
            if ($user->activityRanges->count() > 0) {
                foreach ($user->activityRanges as $activityRange) {
                    $activityRange->delete();
                }
            }
            if (City::find($request->city_in_activity_range)->neighborhoods->count() > 0) {
                if (in_array(0, $request->neighborhood_in_activity_range)) {
                    foreach (City::find($request->city_in_activity_range)->neighborhoods as $neighborhood) {
                        ActivityRange::create([
                            'city_id' => $request->city_in_activity_range,
                            'user_id' => $user->id,
                            'neighborhood_id' => $neighborhood->id,
                            'allNeighborhoods' => 0
                        ]);
                    }
                } else {
                    if (isset($request->neighborhood_in_activity_range))
                        foreach ($request->neighborhood_in_activity_range as $neighborhood) {
                            ActivityRange::create([
                                'city_id' => $request->city_in_activity_range,
                                'user_id' => $user->id,
                                'neighborhood_id' => $neighborhood,
                                'allNeighborhoods' => 0
                            ]);
                        }
                    else
                        ActivityRange::create([
                            'city_id' => $request->city_in_activity_range,
                            'user_id' => $user->id,
                            'allNeighborhoods' => 0
                        ]);
                }
            } else {
                ActivityRange::create([
                    'city_id' => $request->city_in_activity_range,
                    'user_id' => $user->id,
                    'allNeighborhoods' => 1
                ]);
            }
        }
        if (isset($request->whatsapp)) {
            $this->userRepository->createSocialMedia('whatsapp', 'واتساپ', $user, $request->whatsapp);
        }
        if (isset($request->instagram)) {
            $this->userRepository->createSocialMedia('instagram', 'اینستاگرام', $user, $request->instagram);
        }
        if (isset($request->email)) {
            $this->userRepository->createSocialMedia('email', 'ایمیل', $user, $request->email);
        }
        Alert::success('', 'اطلاعات فروشگاه با موفقیت ویرایش شد');
        return redirect(route('user.shop.index.realestate', $user->id));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function myShopAgents(User $user)
    {
        $agentRole = Role::where('slug', 'real-state-agent')->first();
        $agent_ids = DB::table('role_user')->where('role_id', $agentRole->id)->pluck('user_id')->toArray();
        $realStateAgents = User::whereIn('id', $agent_ids)->where('real_estate_admin_id', $user->id)->get();
        return view('Users::realestate.shop.agents', compact('realStateAgents', 'user'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createAgentForm(User $user)
    {
        return view('Users::realestate.shop.createAgent', compact('user'));

    }

    /**
     * @param AgentStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAgent(AgentStoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->file('userImage')) {
            $userImage = $this->uploadFile($request->file('userImage'), 'public/upload/user/userImage/' . now()->year
                . '/' . now()->month);
        } else
            $userImage = null;
        if ($request->file('nationalCardImage')) {
            $nationalCardImage = $this->uploadFile($request->file('nationalCardImage'), 'public/upload/user/nationalCardImage/' . now()->year
                . '/' . now()->month);
        } else
            $nationalCardImage = null;
        if ($request->file('shenasnamehImage')) {
            $shenasnamehImage = $this->uploadFile($request->file('shenasnamehImage'), 'public/upload/user/shenasnamehImage/' . now()->year
                . '/' . now()->month);
        } else
            $shenasnamehImage = null;
        $arr = [];
        $arr[2] = $request->year;
        $arr[1] = $request->month;
        $arr[0] = $request->day;
        $birthDate = implode('-', $arr);
        $user = User::create([
            'userImage' => $userImage,
            'real_estate_admin_id' => $request->id,
            'nationalCardImage' => $nationalCardImage,
            'shenasnamehImage' => $shenasnamehImage,
            'name' => $request->name,
            'sirName' => $request->sirName,
//            'userName' => $request->userName,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'sex' => $request->sex,
            'birthDate' => $birthDate,
            'yearOfOperation' => $request->yearOfOperation,
            'identifierCodeFromRealEstate' => $request->identifierCodeFromRealEstate,
            'phoneNumberForAds' => $request->phoneNumberForAds,
            'input_slug' => $request->slug,
            'password' => bcrypt($request->password),
            'active' => 'active'
        ]);
        $uniqueCode = $user->id + 10000;
        $user->update(['user_id' => $uniqueCode]);
        $user->generateInvitedCode();
        $user->roles()->sync(Role::where('slug', 'real-state-agent')->first()->id);
        if (isset($request->register_invitedCode)) {
            $invited_by = $this->userRepository->find_with_invited_code($request->register_invitedCode);
            if ($invited_by) {
                $this->inviteRepository->create($user, $invited_by);
                $this->scoreController->create_transaction_score('invite-caller-user', $invited_by->id, 'کسب امتیاز به دلیل دعوت دوستان');
                $this->scoreController->create_transaction_score('invite-new-user', $user->id, 'کسب امتیاز جهت ورود کد معرف');
            }
        }
        Alert::success('', 'کارشناس با موفقیت ثبت شد');
        return redirect()->route('user.shop.agents.realestate', $request->id);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteFiles(Request $request): JsonResponse
    {
        $user = User::find($request->id);
        if ($request->card == 'logo') {
            unlink($user->shop_logo);
            $user->update(['shop_logo' => null,]);
        } elseif ($request->card == 'header_image') {
            unlink($user->shop_header_image);
            $user->update(['shop_header_image' => null,]);
        }
        return response()->json(['success' => true]);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function releaseAgentFromAgency($userId): \Illuminate\Http\RedirectResponse
    {
        $user = $this->userRepository->userFindById($userId);
        if (auth()->id() == $user->real_estate_admin_id) {
            foreach ($user->ads->where('agency_id', auth()->id()) as $ad){
                $ad->update([
                    'mobile' => isset(auth()->user()->phoneNumberForAds)?auth()->user()->phoneNumberForAds:
                        (isset(auth()->user()->shop_phone)?auth()->user()->shop_phone:auth()->user()->mobile)
                ]);
            }
            $user->update([
                'real_estate_admin_id' => null,
            ]);
            \alert()->success('', 'کارشناس با موفقیت حذف شد');
            return redirect()->back();
        } else {
            \alert()->error('', 'اجازه رهاسازی این کارشناس را ندارید');
            return redirect()->back();
        }
    }

    public function addExistingAgent()
    {
        return view('Users::realestate.shop.addExistingAgent');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function findAgent(Request $request): JsonResponse
    {
        $user = null;

        if ($request->type == 'code') {
            $user = $this->userRepository->userFindByUserId($request->code);
        } elseif ($request->type == 'username') {
            $user = $this->userRepository->userFindByUsername($request->username);
        } elseif ($request->type == 'mobile') {
            $user = User::where('mobile', $request->mobile)->first();
        }
        $content = '';
        if ($user && isset($user->real_estate_admin_id))
            $content .= '<div style="color: #3c3cce">کارشناس انتخاب شده در حال حاضر زیرمجموعه یک کسب و کار است.</div>';

        if ($user && $user->hasRole('ordinary-user')) {
            $content .= '<table class="table table-hover">';
            if (isset($user->userImage)){
                $content .= '<tr><th>عکس پروفایل</th><td><img src2="'.asset($user->userImage).'" width="80" height="40"></td></tr>';
            }
            $content .= '<tr><th>نام و نام خانوادگی</th><td>' . $user->name . ' ' . $user->sirName . '</td></tr>';
            $content .= '<tr><th>نام کاربری</th><td>' . $user->userName . '</td></tr>';
            $content .= '<tr><th>کد کاربر</th><td>' . $user->user_id . '</td></tr>';
            $content .= '<tr><th>موبایل</th><td>' . $user->mobile . '</td></tr>';
            $content .= '<tr><th>ایمیل</th><td>' . $user->email . '</td></tr>';
            $content .= '<tr><th>جنسیت</th>';
            if ($user->sex == 1)
                $content .= '<td>زن</td></tr>';
            elseif ($user->sex == 0)
                $content .= '<td>مرد</td></tr>';

            $content .= '<tr><th>تاریخ شروع فعالیت</th><td>' . $user->yearOfOperation . '</td></tr>';
            $content .= '<tr><th>تاریخ تولد</th><td>' . $user->birthDate . '</td></tr></table>';
            if (!isset($user->real_estate_admin_id)) {
                $content .= '<div class="row justify-content-center align-items-center mb-5">';
                $content .= '<a class="btn btn-info" href="' . route('user.shop.completeInfo.panel', $user->id) . '">انتخاب کاربر</a>';
            }
        } elseif(!$user) {
            if ($request->type == 'code')
                $content .= '<div style="color: #3c3cce">کاربری با این مشخصات در سایت ثبت نشده است.</div>';
            elseif ($request->type == 'username')
                $content .= '<div style="color: #3c3cce">کاربری با این مشخصات در سایت ثبت نشده است.</div>';
            elseif ($request->type == 'mobile')
                $content .= '<div style="color: #3c3cce">کاربری با این مشخصات در سایت ثبت نشده است، میتوانید این کاربر را به عنوان کارشناس جدید ثبت کنید</div>';

        }elseif($user && !($user->hasRole('ordinary-user') || $user->hasRole('real-state-agent')))
            $content .= '<div style="color: #3c3cce">مجاز یه انتخاب کاربر با این مشخصه نیستید.</div>';

        return response()->json(['content' => $content]);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function chooseExistingAgent($userId): \Illuminate\Http\RedirectResponse
    {
        $user = $this->userRepository->userFindById($userId);
        $user->update([
            'real_estate_admin_id' => auth()->id(),
        ]);
        $user->roles()->sync(Role::where('slug', 'real-state-agent')
            ->first()->id);
        //sms
        \alert()->success('', 'کاربر با موفقیت به کسب و کار شما اضافه شد.');
        return redirect()->route('user.shop.agents.realestate', auth()->id());
    }

    public function completeAgentInfos($userId)
    {
        $user = $this->userRepository->userFindById($userId);
        return view('Users::realestate.shop.completeInfo', compact('user'));

    }

    public function completeAgentInfoPost(Request $request)
    {
        $user = $this->userRepository->userFindById($request->id);
        if ($request->file('userImage')) {
            $userImage = $this->uploadFile($request->file('userImage'), 'public/upload/user/userImage/' . now()->year
                . '/' . now()->month);
        } else
            $userImage = null;
        if ($request->file('nationalCardImage')) {
            $nationalCardImage = $this->uploadFile($request->file('nationalCardImage'), 'public/upload/user/nationalCardImage/' . now()->year
                . '/' . now()->month);
        } else
            $nationalCardImage = null;
        $user->update([
            'real_estate_admin_id' => auth()->id(),
            'input_slug'=>$request->slug,
            'name'=>$request->name,
            'sirName'=>$request->sirName,
            'email'=>$request->email,
            'sex'=>$request->sex,
            'yearOfOperation'=>$request->yearOfOperation,
            'phoneNumberForAds'=>$request->phoneNumberForAds,
            'userImage' => $userImage,
            'nationalCardImage' => $nationalCardImage,
        ]);
        $user->roles()->sync(Role::where('slug', 'real-state-agent')->first()->id);
        Alert::success('', 'کارشناس با موفقیت ثبت شد');
        return redirect(route('user.shop.agents.realestate', auth()->id()));
    }
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function quitFromAgency(): \Illuminate\Http\RedirectResponse
    {
        auth()->user()->update([
            'real_estate_admin_id' => null,
        ]);
        auth()->user()->roles()->sync(Role::where('slug', 'ordinary-user')
            ->first()->id);
        \alert()->success('', 'با موفقیت از کسب و کار خارج شدید.');
        return redirect()->route('user.profile.realestate', auth()->id());
    }

}

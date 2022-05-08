<?php

namespace Modules\User\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\Association\Entities\Association;
use Modules\AssociationSkill\Entities\AssociationSkill;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\Realestate\auth\ChangePasswordRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\AdminMasterNew\Http\Traits;

class UserController extends Controller
{
    use Traits\UploadFileTrait;

    private $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(User $user)
    {
        $agentRole = Role::where('slug', 'real-state-agent')->first();
        $agent_ids = DB::table('role_user')
            ->where('role_id', $agentRole->id)->pluck('user_id')->toArray();
        $realStateAgents = User::whereIn('id', $agent_ids)->get();
        $skills = $user->associationSkills;
        $skills2 = AssociationSkill::all();
        $levelupToAdminOfAgency = $this->settingRepository->getSettingByTitle('levelupToAdminOfAgency');
        if ($user->congrats_check) {
            $user->update(['congrats_check' => 0]);
            \alert()->success('', 'ارتقا اکانت شما به مدیر کسب و کار را تبریک میگوییم.');
        }
        return view('Users::realestate.profile2', compact('user', 'realStateAgents', 'skills',
            'skills2', 'levelupToAdminOfAgency'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteFiles(Request $request): JsonResponse
    {
        $user = User::find($request->id);
        if ($request->card == 'nationalCardImage') {
            unlink($user->nationalCardImage);
            $user->update(['nationalCardImage' => null,]);
        } elseif ($request->card == 'shenasnamehImage') {
            unlink($user->shenasnamehImage);
            $user->update(['shenasnamehImage' => null,]);
        } elseif ($request->card == 'mobasherCardImage') {
            unlink($user->mobasherCardImage);
            $user->update(['mobasherCardImage' => null,]);
        } elseif ($request->card == 'unionCardImage') {
            unlink($user->unionCardImage);
            $user->update(['unionCardImage' => null,]);
        } elseif ($request->card == 'userImage') {
            unlink($user->userImage);
            $user->update(['userImage' => null,]);
        } elseif ($request->card == 'businessLicenseImage') {
            unlink($user->businessLicenseImage);
            $user->update(['businessLicenseImage' => null,]);
        }
        return response()->json(['success' => true]);
    }

    public function detail(User $user)
    {
        return view('Users::realestate.show', compact('user'));
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function activeUser(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $user->update([
                'agent_active' => $request->active,
            ]);
            return json_encode(true);
        } else
            return json_encode(false);
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $associationsLevel1 = Association::where('depth', 1)->get();
        $associations = Association::where('depth', 2)->get();
        $userAssociations = $user->associations;
        $cities = City::all();
        $neighborhoods = Neighborhood::all();
        return view('Users::realestate.edit', compact('user', 'associations',
            'userAssociations', 'cities', 'neighborhoods', 'associationsLevel1'));
    }

    /**
     * @param \Modules\User\Http\Requests\Realestate\UpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(\Modules\User\Http\Requests\Realestate\UpdateRequest $request, User $user): \Illuminate\Http\RedirectResponse
    {
        if ($request->file('userImage')) {
            $userImage = $this->uploadFile($request->file('userImage'), 'public/upload/user/userImage/' . now()->year
                . '/' . now()->month);
        } else
            $userImage = $user->userImage;
        if ($request->file('nationalCardImage')) {
            $nationalCardImage = $this->uploadFile($request->file('nationalCardImage'), 'public/upload/user/nationalCardImage/' . now()->year
                . '/' . now()->month);
        } else
            $nationalCardImage = $user->nationalCardImage;
        if ($request->file('shenasnamehImage')) {
            $shenasnamehImage = $this->uploadFile($request->file('shenasnamehImage'), 'public/upload/user/shenasnamehImage/' . now()->year
                . '/' . now()->month);
        } else
            $shenasnamehImage = $user->shenasnamehImage;

        if ($request->file('mobasherCardImage')) {
            $mobasherCardImage = $this->uploadFile($request->file('mobasherCardImage'), 'public/upload/user/mobasherCardImage/' . now()->year
                . '/' . now()->month);
        } else
            $mobasherCardImage = $user->mobasherCardImage;

        if ($request->file('unionCardImage')) {
            $unionCardImage = $this->uploadFile($request->file('unionCardImage'), 'public/upload/user/unionCardImage/' . now()->year
                . '/' . now()->month);
        } else
            $unionCardImage = $user->unionCardImage;

        if ($request->file('businessLicenseImage')) {
            $businessLicenseImage = $this->uploadFile($request->file('businessLicenseImage'), 'public/upload/user/businessLicenseImage/' . now()->year
                . '/' . now()->month);
        } else
            $businessLicenseImage = $user->businessLicenseImage;
        $arr = [];
        $arr[2] = $request->year;
        $arr[1] = $request->month;
        $arr[0] = $request->day;
        $birthDate = implode('-', $arr);
        if ($request->slug != $user->slug) {
            $user->slug = null;
            $user->save();
        }
        $user->update([
            'userImage' => $userImage,
            'nationalCardImage' => $nationalCardImage,
            'shenasnamehImage' => $shenasnamehImage,
            'mobasherCardImage' => $mobasherCardImage,
            'unionCardImage' => $unionCardImage,
            'businessLicenseImage' => $businessLicenseImage,
            'name' => $request->name,
            'sirName' => $request->sirName,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'sex' => $request->sex,
            'birthDate' => $birthDate,
            'yearOfOperation' => $request->yearOfOperation,
            'phoneNumberForAds' => $request->phoneNumberForAds,
            'input_slug' => $request->slug,
        ]);

        if (isset($request->city)) {
            if ($user->activityRanges->count() > 0) {
                foreach ($user->activityRanges as $activityRange) {
                    $activityRange->delete();
                }
            }
            if (City::find($request->city)->neighborhoods->count() > 0) {
                if (in_array(0, $request->neighborhood)) {
                    foreach (City::find($request->city)->neighborhoods as $neighborhood) {
                        ActivityRange::create([
                            'city_id' => $request->city,
                            'user_id' => $user->id,
                            'neighborhood_id' => $neighborhood->id,
                            'allNeighborhoods' => 0
                        ]);
                    }
                } else {
                    if (isset($request->neighborhood))
                        foreach ($request->neighborhood as $neighborhood) {
                            ActivityRange::create([
                                'city_id' => $request->city,
                                'user_id' => $user->id,
                                'neighborhood_id' => $neighborhood,
                                'allNeighborhoods' => 0
                            ]);
                        }
                    else
                        ActivityRange::create([
                            'city_id' => $request->city,
                            'user_id' => $user->id,
                            'allNeighborhoods' => 0
                        ]);
                }
            } else {
                ActivityRange::create([
                    'city_id' => $request->city,
                    'user_id' => $user->id,
                    'allNeighborhoods' => 1
                ]);
            }
        }
        if ($user->hasRole('contractor')) {
            if (isset($request->association)) {
                $user->associations()->detach();
                foreach ($request->association as $association) {
                    $user->associations()->attach($association);
                }
            }
        }
        Alert::success('', 'کاربر با موفقیت ویرایش شد');
        return redirect()->route('user.profile.realestate', $user->id);

    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePasswordForm(User $user)
    {
        return view('Users::realestate.auth.password.changePassword', compact('user'));
    }

    /**
     * @param ChangePasswordRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request, User $user): \Illuminate\Http\RedirectResponse
    {

        if (Hash::check($request->prev_password, $user->password)) {
            $user->update(['password' => bcrypt($request->new_password)]);
            Alert::success('', 'رمز عبور با موفقیت ویرایش شد.');
            return redirect()->route('user.profile.realestate', $user->id);
        } else {
            Alert::error('', 'رمز عبور فعلی اشتباه است');
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contractorSkillStore(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required',
            'skill' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        foreach ($request->skill as $skill) {
            \auth()->user()->associationSkills()->attach($skill, [
                'value' => $request->value
            ]);
        }
        \alert()->success('', 'مهارت با موفقیت برای شما ثبت شد');
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function contractorSkillUpdate(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required',
//            'skill.*'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errorValidation' => $validator->errors()->all(),
                '</br>'
            ]);
        }
        \auth()->user()->associationSkills()->detach($request->itemid);
        \auth()->user()->associationSkills()->attach($request->itemid, [
            'value' => $request->value
        ]);
        return response()->json([
            'success' => '<div class="alert alert-success"  style="font-size: small">ویرایش با موفقیت انجام شد</div>',
        ]);

    }

    /**
     * @param AssociationSkill $associationSkill
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contractorSkillDestroy(AssociationSkill $associationSkill): \Illuminate\Http\RedirectResponse
    {
        \auth()->user()->associationSkills()->detach($associationSkill->id);
        \alert()->success('', 'مهارت با موفقیت حذف شد');
        return redirect()->back();

    }
}

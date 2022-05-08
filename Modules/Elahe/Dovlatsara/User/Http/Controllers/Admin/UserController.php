<?php

namespace Modules\User\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\Association\Entities\Association;
use Modules\Category\Entities\Category;
use Modules\City\Entities\City;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Entities\Level2CategoryOfAgency;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\Admin\StoreRequest;
use Modules\User\Http\Requests\Admin\UpdateRequest;
use Modules\User\Repositories\UserRepository;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\AdminMasterNew\Http\Traits;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use Traits\UploadFileTrait;

    public $repo;
    private $settingRepository;

    public function __construct(UserRepository $userRepository, SettingRepository $settingRepository)
    {
        $this->repo = $userRepository;
        $this->settingRepository = $settingRepository;
    }

    public function index($type)
    {
        $role = $this->repo->roleFindBySlug($type);
        $user_ids = DB::table('role_user')->where('role_id', $role->id)->pluck('user_id')->toArray();
        $users = $this->repo->usersFindByIds($user_ids);
        return view('Users::admin.index', compact('users', 'role'));
    }

    public function detail($userId)
    {
        $user = $this->repo->userFindById($userId);
        return view('Users::admin.show', compact('user'));

    }

    public function create($type)
    {
        $associationsLevel1 = Association::where('depth', 1)->get();
        $role = $this->repo->roleFindBySlug($type);
        $associations = $this->repo->associationDepth2();
        $cities = $this->repo->cities();
        $real_estates = $this->repo->usersFindByRole('real-state-administrator');
        $categories = Category::where('depth', 1)->get();

        return view('Users::admin.create', compact('associations', 'type', 'role', 'real_estates',
            'cities', 'categories', 'associationsLevel1'));
    }

    public function store(StoreRequest $request)
    {
        $user = $this->repo->create($request);
        $user->update(['active' => 'active']);
        Alert::success('', 'کاربر با موفقیت ثبت شد');
        return redirect()->route('users.index.admin', $this->repo->roleFinById($request->role_id)->slug);
    }

    public function edit(User $user)
    {
        $associationsLevel1 = Association::where('depth', 1)->get();
        $associations = $this->repo->associationDepth2();
        $userAssociations = $user->associations;
        $cities = $this->repo->cities();
        $categories = Category::where('depth', 1)->get();
        $userCategory = Category::find($user->category_id);

        return view('Users::admin.edit', compact('user', 'associations', 'userAssociations',
            'cities', 'categories', 'associationsLevel1', 'userCategory'));
    }

    public function update(UpdateRequest $request, User $user)
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
        $arr[0] = $request->day > 9 ? $request->day : '0' . $request->day;
        $birthDate = implode('-', $arr);
        $user->update([
            'userImage' => $userImage,
            'nationalCardImage' => $nationalCardImage,
            'shenasnamehImage' => $shenasnamehImage,
            'mobasherCardImage' => $mobasherCardImage,
            'unionCardImage' => $unionCardImage,
            'businessLicenseImage' => $businessLicenseImage,
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
            'category_id' => $request->category
        ]);
        if ($user->hasRole('contractor')) {

            $user->associations()->detach();

            foreach ($request->association as $association) {
                $user->associations()->attach($association);
            }
        }
        if ($user->hasRole('real-state-administrator')) {

            foreach ($user->level2CategoryOfAgencies as $subCategory)
                $subCategory->delete();

            foreach ($request->subCategory as $subCat) {
                Level2CategoryOfAgency::create([
                    'user_id' => $user->id,
                    'category_id' => $subCat
                ]);
            }
            foreach ($user->activityRanges as $activityRange)
                $activityRange->delete();
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

        }
        Alert::success('', 'کاربر با موفقیت ویرایش شد');
        if ($user->hasRole('real-state-administrator'))
            return redirect()->route('users.index.admin', 'real-state-administrator');
        elseif ($user->hasRole('real-state-agent'))
            return redirect()->route('users.index.admin', 'real-state-agent');
        elseif ($user->hasRole('independent-agent'))
            return redirect()->route('users.index.admin', 'independent-agent');
        else
            return redirect()->route('users.index.admin', 'ordinary-user');
    }

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
        }
        return response()->json(['success' => true]);
    }

    public function shopConfirm(User $user)
    {
        if ($user) {
            $user->update([
                'shop_active' => 'active',
                'congrats_check' => 1,
            ]);
            $user->roles()->sync(Role::where('slug', 'real-state-administrator')
                ->first()->id);
            Alert::success('', 'فروشگاه تایید شد');
            return redirect()->back();
        } else
            return back();
    }

    public function shopDisConfirm()
    {

        $shop = User::find(request('shopid'));
        if ($shop) {
            $shop->update([
                'shop_active' => 'disConfirm',
                'shop_reasonOfDeactivation' => request('shopreason'),
                'change_to_manager' => 0
            ]);
            $shop->roles()->sync(Role::where('slug', 'ordinary-user')
                ->first()->id);
//            if (DB::table('role_user')->where('role_id', 3)->where('user_id', $shop->user->id)->first())
//            {
//                $shop->user->roles()->attach(2);
//                $shop->user->roles()->detach(3);
//            }
            return response()->json([
                'success' => '<div class="text-success"  style="font-size: large">با موفقیت ثبت شد</div>',
            ]);
        } else
            return response()->json([
                'error' => '<div class="text-danger"  style="font-size: large">کسب و کاری موجود نیست.</div>',
            ]);
    }

    public function activeUser(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $user->update([
                'shop_active' => $request->active,
                'active' => $request->active,
            ]);
            return json_encode(true);
        } else
            return json_encode(false);
    }

    public function destroy($userId)
    {
        $this->repo->delete($userId);
        Alert::success('', 'کاربر با موفقیت حذف شد');
        return redirect()->back();
    }
}

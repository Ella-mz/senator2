<?php


namespace Modules\User\Repositories;


use Illuminate\Support\Facades\DB;
use Modules\Association\Entities\Association;
use Modules\City\Entities\City;
use Modules\RoleAndPermission\Entities\Role;
use Modules\User\Entities\Level2CategoryOfAgency;
use Modules\User\Entities\SocialMedia;
use Modules\User\Entities\User;
use Modules\AdminMasterNew\Http\Traits;

class UserRepository
{
    use Traits\UploadFileTrait;

    public function userFindById($id)
    {
        return User::find($id);
    }

    public function roleFindBySlug($slug)
    {
        return Role::where('slug', $slug)->first();
    }

    public function find_with_invited_code($invitedCode)
    {
        return User::where('invitedCode', $invitedCode)->first();

    }

    public function usersFindByIds($ids)
    {
        return User::with('roles')->whereIn('id', $ids)->orderByDesc('created_at')->get();
    }

    public function userFindBySlug($slug)
    {
        return User::where('slug', $slug)->first();
    }

    public function cities()
    {
        return City::all();
    }

    public function associationDepth2()
    {
        return Association::where('depth', 2)->get();
    }

    public function usersFindByRole($role)
    {
        $user_ids = DB::table('role_user')->where('role_id', Role::where('slug', $role)
            ->first()->id)->pluck('user_id')->toArray();
        return User::whereIn('id', $user_ids)->get();
    }

    public function userFindByToken($token)
    {
        return User::where('api_token', $token)->first();
    }

    public function create($request)
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
        if ($request->file('mobasherCardImage')) {
            $mobasherCardImage = $this->uploadFile($request->file('mobasherCardImage'), 'public/upload/user/mobasherCardImage/' . now()->year
                . '/' . now()->month);
        } else
            $mobasherCardImage = null;
        if ($request->file('unionCardImage')) {
            $unionCardImage = $this->uploadFile($request->file('unionCardImage'), 'public/upload/user/unionCardImage/' . now()->year
                . '/' . now()->month);
        } else
            $unionCardImage = null;
        if ($request->file('businessLicenseImage')) {
            $businessLicenseImage = $this->uploadFile($request->file('businessLicenseImage'), 'public/upload/user/businessLicenseImage/' . now()->year
                . '/' . now()->month);
        } else
            $businessLicenseImage = null;
        if ($request->file('logo')) {
            $logo = $this->uploadFile($request->file('logo'), 'public/upload/user/logo/' . now()->year
                . '/' . now()->month);
        } else
            $logo = null;
        $arr = [];
        $arr[2] = $request->year;
        $arr[1] = $request->month;
        $arr[0] = $request->day;
        $birthDate = implode('-', $arr);
        $user = User::create([
            'userImage' => $userImage,
            'real_estate_admin_id' => $request->real_estate,
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
            'shop_title' => $request->shop_title,
            'shop_logo' => $logo,
            'shop_city_id' => $request->shop_city,
            'shop_neighborhood_id' => $request->neighborhood,
            'shop_website' => $request->shop_website,
            'shop_active' => 'active',
            'password' => bcrypt($request->password),
            'category_id' => $request->category,

        ]);
        $uniqueCode = $user->id + 10000;
        $user->update(['user_id' => $uniqueCode]);
        $user->generateInvitedCode();
        $user->roles()->sync($request->role_id);
        if ($user->hasRole('contractor')) {
            foreach ($request->association as $association) {
                $user->associations()->attach($association);
            }
        }
        if ($user->hasRole('real-state-administrator')) {
            $user->update(['change_to_manager' => 1]);
            foreach ($request->subCategory as $subCat) {
                Level2CategoryOfAgency::create([
                    'user_id' => $user->id,
                    'category_id' => $subCat
                ]);
            }
        }
        return $user;
    }

    public function roleFinById($id)
    {
        return Role::find($id);
    }

    public function delete($id)
    {
        $user = $this->userFindById($id);
        $user->bookmarks()->detach();
        $user->recentSeens()->detach();
        foreach ($user->ads as $ad) {
            $ad->update(['deleted_user' => auth()->id()]);
            $ad->delete();
        }
        $user->update(['deleted_user' => auth()->id()]);
        $user->delete();

    }

    public function usersGetByMobile($mobile)
    {
        return User::where('mobile', $mobile)->get();
    }

    public function userIdsFindByRole($role): array
    {
        return DB::table('role_user')->where('role_id', Role::where('slug', $role)
            ->first()->id)->pluck('user_id')->toArray();
    }

    public function agents($id)
    {
        return User::where('real_estate_admin_id', $id)->where('active', 'active')->where('shop_active', 'active')->get();
    }

    public function createSocialMedia($type, $type_persian, $user, $link)
    {
        if (SocialMedia::where('user_id', $user->id)->where('type', $type)->first()) {
            SocialMedia::where('user_id', $user->id)->where('type', $type)->update([
                'type_persian' => $type_persian,
                'link' => $link
            ]);
        } else
            SocialMedia::create([
                'user_id' => $user->id,
                'type' => $type,
                'type_persian' => $type_persian,
                'link' => $link
            ]);
    }

    public function userFindByUserId($userId)
    {
        return User::where('user_id', $userId)->first();
    }

    public function userFindByUsername($username)
    {
        return User::where('username', $username)->first();
    }
}

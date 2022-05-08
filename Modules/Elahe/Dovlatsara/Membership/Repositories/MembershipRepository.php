<?php


namespace Modules\Membership\Repositories;


use Illuminate\Support\Facades\DB;
use Modules\ApplicantMembership\Entities\ApplicantMembership;
use Modules\Membership\Entities\Membership;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Entities\AdminSetting;
use Modules\User\Entities\User;

class MembershipRepository
{
    public function getAllActiveMembership()
    {
        return Membership::where('active', 1)->orderByDesc('created_at')->get();
    }

    public function membershipFindById($id)
    {
        return Membership::find($id);
    }
    public function findRoleBySlug($item)
    {
        return Role::where('slug', $item)->first();
    }

    public function adminSetting($item)
    {
        return AdminSetting::where('title', $item)->first()->value;
    }

    public function membershipsFindByRoleType($roleType)
    {
        return Membership::where('active', 1)->where('role_type', $roleType)->get();
    }
    public function applicantMembershipsFindByRoleType($roleType)
    {
        return ApplicantMembership::where('active', 1)->where('role_type', $roleType)->get();
    }

    public function findUserById($id)
    {
        return User::find($id);
    }

    public function membershipIds()
    {
        return Membership::pluck('id')->toArray();
    }


    public function membershipIdsByRoleTypeAndPackageType($roleType, $packageType)
    {
        return Membership::where('package_type', $packageType)
            ->where('role_type', $roleType)->pluck('id')->toArray();
    }

    public function membershipUserIdsByMembershipIds($membershipIds)
    {
        return DB::table('membership_user')->where('user_id', auth()->id())
//            ->whereIn('membership_id', $membershipIds)
            ->pluck('id')->toArray();
    }

    public function membershipUserByMembershipUserIds($membershipUserIds)
    {
        return  DB::table('membership_user')->whereIn('id', $membershipUserIds)
            ->orderByDesc('endDate')->first();
    }
}

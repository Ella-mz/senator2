<?php


namespace Modules\ApplicantMembership\Repositories;


use Modules\ApplicantMembership\Entities\ApplicantMembership;
use Modules\Category\Entities\Category;
use Modules\RoleAndPermission\Entities\Role;

class ApplicantMembershipRepository
{
    public function getAllActiveApplicantMembership()
    {
        return ApplicantMembership::where('active', 1)->get();
    }

    public function applicantMembershipFindById($id)
    {
        return ApplicantMembership::find($id);
    }

    public function categoriesDepth1()
    {
        return Category::where('depth', 1)->get();
    }

    public function findRoleBySlug($item)
    {
        return Role::where('slug', $item)->first();
    }


}

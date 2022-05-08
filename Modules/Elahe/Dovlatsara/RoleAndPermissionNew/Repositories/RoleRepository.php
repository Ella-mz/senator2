<?php


namespace Modules\RoleAndPermissionNew\Repositories;


use Modules\RoleAndPermissionNew\Entities\RoleNew;

class RoleRepository
{
    public function roles()
    {
        return RoleNew::all();
    }
}

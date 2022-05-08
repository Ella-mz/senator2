<?php


namespace Modules\RoleAndPermissionNew\Repositories;


use Modules\RoleAndPermissionNew\Entities\PermissionNew;

class PermissionRepository
{
    public function create($requests)
    {
        foreach ($requests as $request){
            PermissionNew::create($request);
        }
    }

    public function delete()
    {
        foreach (PermissionNew::all() as $setting){
            $setting->delete();
        }
    }
}

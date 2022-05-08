<?php


namespace Modules\Hologram\Repositories;


use Illuminate\Support\Facades\DB;
use Modules\Ad\Entities\Ad;
use Modules\Hologram\Entities\Hologram;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Entities\AdminSetting;
use Modules\User\Entities\User;

class HologramRepository
{
    public function userFindByToken($token)
    {
        return User::where('api_token', $token)->first();
    }

    public function userIdFindByToken($token)
    {
        return User::where('api_token', $token)->pluck('id')->toArray();
    }
    public function hologramFindById($id)
    {
        return Hologram::find($id);
    }

    public function adminSettingFindByTitle($title)
    {
        return AdminSetting::where('title', $title)->first();
    }

    public function findUserIdsByRole($role)
    {
        return DB::table('role_user')->where('role_id', Role::where('slug', $role)->first()->id)
            ->pluck('user_id')->toArray();
    }


}

<?php namespace Modules\Hologram\Http\Traits;

use Illuminate\Support\Facades\DB;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\RoleAndPermission\Entities\Role;
use Modules\User\Entities\User;

trait chooseExpertTrait
{

    public function selectExpert()
    {
        $user_ids = DB::table('role_user')->where('role_id', Role::where('slug', 'expert')->first()->id)
            ->pluck('user_id')->toArray();
        $array=[];
        foreach (User::whereIn('id', $user_ids)->get() as $user){
            $array[$user->id] = HologramInterface::where('expert_id', $user->id)->where('isPaid', 1)->count();
        }
        $min_key = array_key_last($array);
        $min = end($array);
        foreach ($array as $key => $val) {
            if ($min > $val) {
                $min = $val;
                $min_key = $key;
            }
        }
        return $min_key;
    }

}

<?php


namespace Modules\HologramInterface\Repositories;


use Modules\Ad\Entities\Ad;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\User\Entities\User;

class HologramInterfaceRepository
{

    public function hologramInterfaceFindById($id)
    {
        return HologramInterface::find($id);
    }
    public function userFindByToken($token)
    {
        return User::where('api_token', $token)->first();
    }

    public function userIdFindByToken($token)
    {
        return User::where('api_token', $token)->pluck('id')->toArray();
    }

    public function hologramInterFaceWithTypeAndTypeId($type, $typeIds)
    {
        return HologramInterface::where('type', $type)->whereIn('type_id', $typeIds)->orderByDesc('created_at')->get();
    }

    public function hologramInterFaceWithTypeAndTypeIdWithPaginat($type, $typeIds)
    {
        return HologramInterface::where('type', $type)->whereIn('type_id', $typeIds)->orderByDesc('created_at')->paginate(2);

    }

    public function adIdsByUserId($id)
    {
        return Ad::where('user_id', $id)->pluck('id')->toArray();
    }
}

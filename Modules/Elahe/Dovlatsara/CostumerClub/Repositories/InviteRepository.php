<?php
namespace Modules\CostumerClub\Repositories;

use Modules\CostumerClub\Entities\Invite;

class InviteRepository
{
    public function create($user, $invited_by)
    {
        return Invite::create([
            'user_id'=>$user->id,
            'invited_by'=>$invited_by->id,

        ]);
    }
}

<?php

namespace Modules\ActivityRange\Repositories;

use Modules\ActivityRange\Entities\ActivityRange;

class ActivityRangeRepository
{
    public function userIdsFindByCityId($id)
    {
        return ActivityRange::where('city_id', $id)->pluck('user_id')->toArray();
    }

    public function userIdsFindByNeighborhoodIds($ids)
    {
        return ActivityRange::whereIn('neighborhood_id', $ids)->pluck('user_id')->toArray();
    }
}

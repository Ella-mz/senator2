<?php

namespace Modules\Neighborhood\Repositories;

use Modules\Neighborhood\Entities\Neighborhood;

class NeighborhoodRepository
{
    public function all()
    {
        return Neighborhood::all();
    }
}

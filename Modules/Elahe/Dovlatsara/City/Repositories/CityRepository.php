<?php

namespace Modules\City\Repositories;

use Modules\City\Entities\City;

class CityRepository
{
    public function all()
    {
        return City::all();
    }

    public function cityFindById($id)
    {
        return City::find($id);
    }
}

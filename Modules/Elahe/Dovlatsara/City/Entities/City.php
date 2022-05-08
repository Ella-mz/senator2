<?php

namespace Modules\City\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\Ad\Entities\Ad;
use Modules\Neighborhood\Entities\Neighborhood;

class City extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'latitude', 'longitude', 'active', 'created_user', 'updated_user', 'deleted_user'];

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class, 'city_id');
    }

    public function ads()
    {
        return $this->hasMany(Ad::class, 'city_id');
    }

    public function activityRanges()
    {
        return $this->hasMany(ActivityRange::class, 'city_id');
    }
}

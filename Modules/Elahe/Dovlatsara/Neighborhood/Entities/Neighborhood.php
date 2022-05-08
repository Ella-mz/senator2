<?php

namespace Modules\Neighborhood\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\Ad\Entities\Ad;
use Modules\City\Entities\City;

class Neighborhood extends Model
{
    use SoftDeletes;

    protected $fillable = ['city_id', 'title', 'geographicalDirection', 'latitude', 'longitude', 'active',
        'created_user', 'updated_user', 'deleted_user'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function activityRanges()
    {
        return $this->hasMany(ActivityRange::class, 'neighborhood_id');
    }

    public function ads()
    {
        return $this->hasMany(Ad::class, 'neighborhood_id');
    }
}

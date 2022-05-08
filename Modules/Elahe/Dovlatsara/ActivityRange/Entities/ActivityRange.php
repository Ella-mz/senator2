<?php

namespace Modules\ActivityRange\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;

//use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityRange extends Model
{
//    use HasFactory;

    protected $fillable = ['user_id', 'city_id', 'neighborhood_id', 'allNeighborhoods', 'created_user', 'updated_user', 'deleted_user'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

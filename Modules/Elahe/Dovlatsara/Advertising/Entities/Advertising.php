<?php

namespace Modules\Advertising\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Entities\User;

class Advertising extends Model
{
    use SoftDeletes;

    protected $fillable = ['advertising_order_id', 'title', 'price', 'description', 'created_user', 'updated_user', 'deleted_user'];

    public function advertisingOrder()
    {
        return $this->belongsTo(AdvertisingOrder::class, 'advertising_order_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'advertising_user', 'advertising_id', 'user_id');
    }

    public function advertisingApplicants()
    {
        return $this->hasMany(AdvertisingApplication::class, 'advertising_id');
    }
}

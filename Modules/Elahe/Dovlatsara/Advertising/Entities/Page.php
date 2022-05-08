<?php

namespace Modules\Advertising\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'fa_title', 'hasCategory', 'hasUser', 'created_user', 'updated_user', 'deleted_user'];

    public function advertisingOrders()
    {
        return $this->hasMany(AdvertisingOrder::class, 'page_id');
    }
}

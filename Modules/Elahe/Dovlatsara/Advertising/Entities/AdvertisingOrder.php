<?php

namespace Modules\Advertising\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertisingOrder extends Model
{
    use SoftDeletes;

    protected $fillable = ['page_id', 'location', 'image', 'fa_title' ,'description', 'created_user', 'updated_user', 'deleted_user'];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function advertisings()
    {
        return $this->hasMany(Advertising::class, 'advertising_order_id');
    }
}

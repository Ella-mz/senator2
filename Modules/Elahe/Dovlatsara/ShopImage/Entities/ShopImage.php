<?php

namespace Modules\ShopImage\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Shop\Entities\Shop;

class ShopImage extends Model
{
    protected $fillable = ['shop_id', 'image', 'active', 'created_user', 'updated_user', 'deleted_user'];

    public function ad()
    {
        return $this->belongsTo(Shop::class, 'shop_id')->withTrashed();
    }
}

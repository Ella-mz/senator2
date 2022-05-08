<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\ShopImage\Entities\ShopImage;
use Modules\Union\Entities\Union;

//use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model
{
//    use HasFactory;

    protected $fillable = ['union_id', 'city_id', 'neighborhood_id', 'identifierCode', 'title', 'phone', 'address'
    , 'latitude', 'longitude', 'logo', 'yearOfOperation', 'slug', 'description', 'website', 'reasonOfDeactivation',
        'active', 'created_user', 'updated_user', 'deleted_user'];

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id');
    }
    public function shopImages()
    {
        return $this->hasMany(ShopImage::class, 'shop_id');
    }


}

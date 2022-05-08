<?php namespace Modules\Ad\Traits;


use Modules\Ad\Entities\AdVideo;
use Modules\Ad\Entities\Catalog;
use Modules\AdImageNew\Entities\AdImageNew;
use Modules\Attribute\Entities\Attribute;
use Modules\AttributeItem\Entities\AttributeItem;
use Modules\Bookmark\Entities\Bookmark;
use Modules\Category\Entities\Category;
use Modules\City\Entities\City;
use Modules\Hologram\Entities\Hologram;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\User\Entities\User;

trait AdRelationsTrait
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }

    public function adImages()
    {
        return $this->hasMany(AdImageNew::class, 'ad_id');
    }

    public function adVideos()
    {
        return $this->hasMany(AdVideo::class, 'ad_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class,'ad_attribute',
            'ad_id', 'attribute_id')
            ->withPivot('ad_id', 'attribute_id', 'value', 'attribute_item_id', 'alt_value');
    }

    public function attributeItems()
    {
        return $this->belongsToMany(AttributeItem::class,'ad_attribute',
            'ad_id', 'attribute_item_id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'ad_id');
    }

    public function holograms()
    {
        return $this->belongsToMany(Hologram::class, 'hologram_interfaces', 'ad_id',
            'type_id');
    }

    public function adCatalogs()
    {
        return $this->hasMany(Catalog::class, 'ad_id');
    }
}

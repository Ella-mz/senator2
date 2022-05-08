<?php

namespace Modules\Application\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Attribute\Entities\Attribute;
use Modules\AttributeItem\Entities\AttributeItem;
use Modules\Category\Entities\Category;
use Modules\City\Entities\City;
use Modules\User\Entities\User;

class Application extends Model
{
    use SoftDeletes;
    /**
     * active=> 'active' OR 'inactive' OR 'disConfirm'
     *
    */

    protected $fillable = ['user_id', 'category_id', 'city_id', 'title', 'phone', 'startDate', 'endDate', 'description', 'active',
        'activationReason', 'created_user', 'updated_user', 'deleted_user', 'agency_id', 'dedicated_type', 'request_to_agency', 'mobile'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withTrashed();
    }

    public function neighborhoods()
    {
        return $this->hasMany(ApplicationNeighborhood::class, 'application_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class,'application_attribute',
            'application_id', 'attribute_id')
            ->withPivot('application_id', 'attribute_id', 'value1', 'attribute_item_id1', 'value2', 'attribute_item_id2');
    }

    public function attributeItems1()
    {
        return $this->belongsToMany(AttributeItem::class,'application_attribute',
            'application_id', 'attribute_item_id1');
    }

    public function attributeItems2()
    {
        return $this->belongsToMany(AttributeItem::class,'application_attribute',
            'application_id', 'attribute_item_id2');
    }

    static $enumRequestToAgency =
        [
            'noRequest',
            'pending',
            'approved',
            'disapproved'
        ];

    static $enumDedicatedType =
        [
            'user_to_agency',
            'agency_to_user',
        ];
}

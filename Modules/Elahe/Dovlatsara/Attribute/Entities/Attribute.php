<?php

namespace Modules\Attribute\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ad\Entities\Ad;
use Modules\Application\Entities\Application;
use Modules\AttributeItem\Entities\AttributeItem;
use Modules\GroupAttribute\Entities\GroupAttribute;

class Attribute extends Model
{
    use SoftDeletes;
    /**define Order fallible fields.
     *
     * @var string[]
     */

    protected $fillable = ['groupAttribute_id', 'title', 'attribute_type','input_type', 'unit',
        'min', 'max', 'isSignificant', 'isFilterField', 'active', 'placeHolder', 'hasScale', 'alt_value',
        'category_id', 'created_at', 'updated_at', 'deleted_at', 'created_user','updated_user', 'deleted_user'];

    public function groupAttribute()
    {
        return $this->belongsTo(GroupAttribute::class, 'groupAttribute_id');

    }

    public function attributeItems()
    {
        return $this->hasMany(AttributeItem::class, 'attribute_id');

    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class,'ad_attribute',
            'attribute_id', 'ad_id')
            ->withPivot('ad_id', 'attribute_id', 'value', 'attribute_item_id');
    }

    public function applications()
    {
        return $this->belongsToMany(Application::class,'application_attribute',
            'attribute_id', 'application_id')
            ->withPivot('application_id', 'attribute_id', 'value1', 'attribute_item_id1', 'value2', 'attribute_item_id2');
    }

}

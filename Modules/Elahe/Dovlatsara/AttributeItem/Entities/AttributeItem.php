<?php

namespace Modules\AttributeItem\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ad\Entities\Ad;
use Modules\Attribute\Entities\Attribute;


class AttributeItem extends Model
{

    use SoftDeletes;
    /**define Order fallible fields.
     *
     * @var string[]
     */

    protected $fillable = ['attribute_id', 'title', 'active',
        'created_at', 'updated_at', 'deleted_at', 'created_user','updated_user', 'deleted_user'];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');

    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class,'ad_attribute',
            'attribute_item_id', 'ad_id')
            ->withPivot('ad_id', 'attribute_id', 'value', 'attribute_item_id');
    }
}

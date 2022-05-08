<?php

namespace Modules\GroupAttribute\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Attribute\Entities\Attribute;
use Modules\Category\Entities\Category;

class GroupAttribute extends Model
{
    /**
     * advertiser => 'supplier' OR 'applicant'
     *
     * type:
     * if advertiser=>'supplier' ==> type => 'estate-information' OR 'estate-features' OR 'financial-situation'
     * elseif advertiser=>'applicant' ==> type => 'none'
    */
    use SoftDeletes;
    /**define Order fallible fields.
     *
     * @var string[]
     */

    protected $fillable = ['id', 'title', 'order','numberOfColumnsForDisplay', 'advertiser', 'active', 'type', 'hidden',
        'category_id', 'created_at', 'updated_at', 'deleted_at', 'created_user','updated_user', 'deleted_user'];

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'groupAttribute_id');

    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');

    }
}

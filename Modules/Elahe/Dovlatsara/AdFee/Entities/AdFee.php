<?php

namespace Modules\AdFee\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Entities\Category;

class AdFee extends Model
{
    use SoftDeletes;
    /**define Order fallible fields.
     *
     * @var string[]
     */

    protected $fillable = ['category_id', 'expireTimeOfAds', 'active', 'generalAdFee', 'scalarAdFee', 'specialAdFee',
        'emergencyAdFee', 'created_at', 'updated_at', 'deleted_at', 'created_user','updated_user', 'deleted_user'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');

    }
    protected $table = 'advertising_fees';

}

<?php

namespace Modules\AdImageNew\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Ad\Entities\Ad;

class AdImageNew extends Model
{
    protected $fillable = ['ad_id', 'image', 'active', 'created_user', 'updated_user', 'deleted_user'];

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id')->withTrashed();
    }

    protected $table = 'ad_images';

}

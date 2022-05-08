<?php

namespace Modules\AdImage\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Ad\Entities\Ad;

class AdImage extends Model
{

    protected $fillable = ['ad_id', 'image', 'active', 'created_user', 'updated_user', 'deleted_user'];

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id')->withTrashed();
    }
}

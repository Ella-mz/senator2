<?php

namespace Modules\Ad\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdVideo extends Model
{
    use SoftDeletes;

    protected $fillable = ['ad_id', 'video', 'active', 'created_user', 'updated_user', 'deleted_user'];

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id')->withTrashed();
    }
}

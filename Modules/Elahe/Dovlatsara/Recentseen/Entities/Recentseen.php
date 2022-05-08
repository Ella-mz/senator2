<?php

namespace Modules\Recentseen\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Ad\Entities\Ad;
use Modules\User\Entities\User;


class Recentseen extends Model
{

    protected $fillable = ['ad_id', 'user_id', 'active', 'created_user', 'updated_user', 'deleted_user', 'isSeen'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id')->withTrashed();
    }
}

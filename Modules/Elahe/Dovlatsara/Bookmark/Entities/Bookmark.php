<?php

namespace Modules\Bookmark\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Ad\Entities\Ad;
use Modules\User\Entities\User;

//use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bookmark extends Model
{
//    use HasFactory;

    protected $fillable = ['ad_id','user_id', 'status',
        'active', 'created_user', 'updated_user', 'deleted_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id')->withTrashed();
    }
}

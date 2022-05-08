<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id','type', 'type_persian', 'link', 'image', 'created_user', 'updated_user', 'deleted_user',];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    static $enumType =
        [
            'instagram',
            'whatsapp',
            'email'
        ];
}

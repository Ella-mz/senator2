<?php

namespace Modules\EnumType\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Enum\Entities\Enum;

class EnumType extends Model
{

    protected $fillable = ['enum_id', 'map', 'link', 'email', 'mobile', 'phone', 'description', 'title',
        'image', 'created_user', 'updated_user', 'deleted_user'];

    public function enum()
    {
        return $this->belongsTo(Enum::class, 'enum_id');
    }
}

<?php

namespace Modules\Ad\Entities;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{

    protected $fillable = ['ad_id', 'description', 'file_address', 'file_name', 'file_extension',
        'created_user', 'updated_user', 'deleted_user'];

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'ad_id')->withTrashed();
    }

}

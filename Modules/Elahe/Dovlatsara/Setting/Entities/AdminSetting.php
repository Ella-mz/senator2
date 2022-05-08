<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    protected $fillable = ['title', 'en_title', 'fa_title','value', 'created_user', 'updated_user', 'deleted_user'];

    /**
     * title=>hologram_publish
     * value=> auto OR manual
     *
     *  title=>ads_type_of_watermark
     * value=> ImageAndText OR Image OR Text OR None
     *
     * title=>map_service
     * value=> neshan OR map.ir
     */
}

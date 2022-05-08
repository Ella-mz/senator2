<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{


    /**
     * type ===> text OR file OR longtext OR number OR color OR fileAndLink
     *
     */

    protected $fillable = ['title','int_value','str_value', 'fa_title', 'type', 'link', 'created_user', 'updated_user', 'deleted_user'];


}

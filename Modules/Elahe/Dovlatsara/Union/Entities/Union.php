<?php

namespace Modules\Union\Entities;

use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    protected $fillable = ['title', 'active', 'created_user', 'updated_user', 'deleted_user'];

}

<?php

namespace Modules\CommonQuestion\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonQuestion extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'active', 'created_user', 'updated_user', 'deleted_user'];

}

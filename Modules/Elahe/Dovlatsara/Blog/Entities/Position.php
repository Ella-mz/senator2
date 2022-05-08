<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Traits\PositionRelationsTrait;

class Position extends Model
{
    use PositionRelationsTrait;
//    use global_scopes;


    protected $fillable = [
        'title',
        'slug',
        'name',
        'image',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',

    ];
    static $enumStatuses = [
        'active',
        'inactive',
    ];
}


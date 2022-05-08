<?php

namespace Modules\CostumerClub\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
    use SoftDeletes, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'input_slug',
        'bonus',
        'grant',
        'type',
        'status',
        'description',
        'created_user',
        'updated_user',
        'deleted_user',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'input_slug'
            ]
        ];
    }

    static $enumStatuses = [
        'active',
        'deactivate',
    ];
    static $enumTypes = [
        'increase',
        'decrease',
    ];
}

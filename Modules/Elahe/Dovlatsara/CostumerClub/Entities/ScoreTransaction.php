<?php

namespace Modules\CostumerClub\Entities;

use Illuminate\Database\Eloquent\Model;

class ScoreTransaction extends Model
{

    protected $fillable = [
        'user_id',
        'score_id',
        'bonus',
        'grant',
        'type',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    static $enumTypes = [
        'decrease',
        'increase',
    ];
}

<?php

namespace Modules\CostumerClub\Entities;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'user_id',
        'invited_by',
    ];
}

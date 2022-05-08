<?php

namespace Modules\CostumerClub\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'price',
        'type',
        'status',
        'order_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    static $enumStatuses = [
        'active',
        'deactivate',
    ];
    static $enumTypes = [
        'decrease',
        'increase',
    ];
}

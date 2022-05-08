<?php

namespace Modules\CostumerClub\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    protected  $fillable=[
        'user_id',
        'wallet_balance',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

}

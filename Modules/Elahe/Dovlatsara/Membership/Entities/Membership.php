<?php

namespace Modules\Membership\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Membership extends Model
{
    protected $fillable = ['title', 'duration', 'role_type', 'score', 'price', 'active', 'package_type',
        'created_user', 'updated_user', 'deleted_user', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'membership_user')
            ->withPivot('startDate', 'endDate', 'score');

    }

}

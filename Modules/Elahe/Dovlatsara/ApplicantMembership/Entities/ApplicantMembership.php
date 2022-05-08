<?php

namespace Modules\ApplicantMembership\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class ApplicantMembership extends Model
{
    protected $fillable = ['category_id', 'title', 'duration', 'role_type', 'price', 'active', 'number_of_applications',
        'created_user', 'updated_user', 'deleted_user'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'applicant_membership_user')
            ->withPivot('startDate', 'endDate', 'remain_number_of_applications', 'number_of_applications');
    }
}

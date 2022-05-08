<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ad\Entities\Ad;
use Modules\Advertising\Entities\Advertising;
use Modules\ApplicantMembership\Entities\ApplicantMembership;
use Modules\Membership\Entities\Membership;
use Modules\User\Entities\User;


class Order extends Model
{
    use SoftDeletes;

    /**
     * @var mixed
     */
    protected $fillable = ['user_id', 'type_id', 'price', 'description', 'type', 'status',
        'created_user', 'updated_user', 'deleted_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'type_id')->withTrashed();
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'type_id');
    }


    public function applicantMembership()
    {
        return $this->belongsTo(ApplicantMembership::class, 'type_id');
    }

    public function advertising()
    {
        return $this->belongsTo(Advertising::class, 'type_id')->withTrashed();
    }

    static $enumType =
        [
            'ad',
            'membership',
            'applicantMembership',
            'advertisement',
            'hologram',
        ];

    static $enumStatus =
        [
            'paid',
            'unpaid',
        ];

}

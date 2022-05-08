<?php

namespace Modules\Ad\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ad\Traits\AdRelationsTrait;
use Modules\Ad\Traits\AdScopesTrait;

//use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * priority ===>
 * 1=>scalar
 * 2=>emergency
 * 2=>general
 * 2=>special
 *
 *
 * type====>
 * general
 * scalar
 * special
 * emergency
 *
 * paymentType===>
 * membership
 * free
 * adFee
 * admin
 *
 * userStatus===>
 * active
 * inactive
 * onlyEstatePanel
 *
 * active===>
 * active
 * inactive
 * delete
 * disConfirm
 *
 * isPaid===>
 * paid
 * unpaid
 *
 * advertiser===>
 * supplier
 * applicant
 *
 */

class Ad extends Model
{
    use SoftDeletes, AdRelationsTrait, AdScopesTrait;

    protected $fillable = ['title', 'user_id', 'category_id', 'neighborhood_id', 'startDate', 'endDate',
        'description', 'active', 'viewCount', 'attribute_id', 'isShop', 'priority',
        'advertiser', 'type', 'mobile', 'hasChat', 'showEmail', 'hasEmail', 'dedicated_type',
        'latitude', 'longitude', 'showMobile', 'city_id', 'paymentType', 'request_to_agency',
        'uniqueCodeOfAd', 'isPaid', 'userStatus', 'agent_active', 'agency_id', 'text_watermark_color',
        'created_user', 'updated_user', 'deleted_user', 'deactivationReason', 'address'];


    static $enumRequestToAgency =
        [
            'noRequest',
            'pending',
            'approved',
            'disapproved'
        ];

    static $enumDedicatedType =
        [
            'user_to_agency',
            'agency_to_user',
        ];
}

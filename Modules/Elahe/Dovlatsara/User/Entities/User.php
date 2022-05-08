<?php

namespace Modules\User\Entities;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\Ad\Entities\Ad;
use Modules\Advertising\Entities\Advertising;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\ApplicantMembership\Entities\ApplicantMembership;
use Modules\Application\Entities\Application;
use Modules\Article\Entities\Article;
use Modules\Association\Entities\Association;
use Modules\AssociationSkill\Entities\AssociationSkill;
use Modules\City\Entities\City;
use Modules\Comment\Entities\Comment;
use Modules\ContractorProject\Entities\ContractorProject;
use Modules\Hologram\Entities\Hologram;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\Membership\Entities\Membership;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\RoleAndPermission\Entities\Role;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Sluggable;

    /**
     * active===>
     * active
     * inactive
     *
     * shop_active===>
     * active
     * inactive
     *
     * agent_active===>
     * active
     * inactive
     *
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'userImage', 'sirName', 'userImage', 'sex', 'birthDate', 'slug',
        'invitedCode', 'nationalCardImage', 'shenasnamehImage', 'yearOfOperation', 'mobasherCardImage',
        'businessLicenseImage', 'unionCardImage', 'phoneNumberForAds', 'shop_id', 'active', 'agent_active',
        'created_user', 'updated_user', 'deleted_user', 'shop_city_id', 'shop_neighborhood_id', 'shop_title',
        'shop_phone', 'shop_address', 'shop_latitude', 'shop_longitude', 'shop_logo', 'shop_description', 'shop_website',
        'shop_active', 'shop_reasonOfDeactivation', 'real_estate_admin_id', 'verification_code', 'api_token', 'input_slug',
        'user_id', 'userName', 'category_id', 'shop_header_image', 'shop_header_title', 'nationalCode',
        'change_to_manager', 'congrats_check'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'input_slug'
            ]
        ];
    }

    public function generateToken(): string
    {
        $token = Str::random(40);
        if (User::where('api_token', $token)->first())
            $this->generateToken();
        $this->api_token = $token;
        $this->save();
        return $token;
    }

    public function generateInvitedCode(): string
    {
        $invitedCode = Str::random(10);
        if (User::where('invitedCode', $invitedCode)->first())
            $this->generateInvitedCode();
        $this->invitedCode = $invitedCode;
        $this->save();
        return $invitedCode;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasRole($role)
    {
        if(is_string($role)){
            return $this->roles->contains('slug', $role);
        }
        return !! $role->intersect($this->roles)->count();

    }

    public function hasPermission($permission)
    {
        if(is_string($permission)){
            foreach ($this->roles as $role){
                return $role->permissions->contains('slug', $permission);
            }
//            return $this->roles->contains('slug', $role);
        }else
            return false;
//        return !! $role->intersect($this->roles)->count();

    }

    public function memberships()
    {
        return $this->belongsToMany(Membership::class, 'membership_user')
            ->withPivot('startDate', 'endDate', 'score', 'remain_score');
    }
    public function applicantMemberships()
    {
        return $this->belongsToMany(ApplicantMembership::class, 'applicant_membership_user')
            ->withPivot('startDate', 'endDate', 'remain_number_of_applications', 'number_of_applications');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'shop_city_id')->withTrashed();
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'shop_neighborhood_id')->withTrashed();
    }

    public function associationSkills()
    {
        return $this->belongsToMany(AssociationSkill::class, 'association_skill_user')
            ->withPivot('value');
    }
    public function associations()
    {
        return $this->belongsToMany(Association::class, 'association_user', 'user_id',
        'association_id');
    }

    public function contractorProjects()
    {
        return $this->hasMany(ContractorProject::class, 'user_id');
    }

    public function activityRanges()
    {
        return $this->hasMany(ActivityRange::class, 'user_id');
    }

    public function holograms()
    {
        return $this->belongsToMany(Hologram::class, 'hologram_interfaces', 'type_id');
    }

    public function hologramInterfaces()
    {
        return $this->hasMany(HologramInterface::class, 'type_id');
    }

    public function ads()
    {
        return $this->hasMany(Ad::class, 'user_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id')->withTrashed();
    }

    public function recentSeens()
    {
        return $this->belongsToMany(Ad::class, 'recentseens', 'user_id',
            'ad_id');
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Ad::class, 'bookmarks', 'user_id',
            'ad_id');
    }

    public function advertisings()
    {
        return $this->belongsToMany(Advertising::class, 'advertising_user', 'user_id', 'advertising_id');

    }

    public function advertisingApplicants()
    {
        return $this->hasMany(AdvertisingApplication::class, 'user_id')->withTrashed();
    }

    public function socialMedias()
    {
        return $this->hasMany(SocialMedia::class, 'user_id')->withTrashed();
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'user_id');
    }

    public function allAdsOfAgency()
    {
        return Ad::where(function ($query) {
            $query->where('agency_id', $this->id)
                ->where('isPaid', 'paid')
                ->where('active', 'active')
                ->where('userStatus', '!=', 'inactive')
                ->where('endDate', '>', Carbon::now())
                ->where('advertiser', 'supplier')
                ->where('request_to_agency', 'approved');
        })->orWhere(function ($query) {
            $query->where('agency_id', $this->id)
                ->where('isPaid', 'paid')
                ->where('active', 'active')
                ->where('userStatus', '!=', 'inactive')
                ->where('endDate', '>', Carbon::now())
                ->where('advertiser', 'supplier')
                ->where('request_to_agency', 'noRequest');
        })->get();
    }

    public function agency()
    {
        return $this->belongsTo(User::class, 'real_estate_admin_id');
    }
//    public function shopAdsCount($userId)
//    {
////        $user = User::find($userId);
////        $agentAds = 0;
////        foreach (User::where('real_estate_admin_id', $userId)->get() as $agent){
////            $agentAds += $agent->ads->where('agency_id', $userId)->count();
////        }
////        $shopOwnerAds = $user->ads->count();
////        return $shopOwnerAds+$agentAds;
//    }

    public function level2CategoryOfAgencies()
    {
        return $this->hasMany(Level2CategoryOfAgency::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}

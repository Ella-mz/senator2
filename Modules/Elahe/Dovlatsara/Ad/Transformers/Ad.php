<?php

namespace Modules\Ad\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AdImageNew\Transformers\AdImageCollection;
use Modules\AttributeItem\Entities\AttributeItem;
use Modules\Bookmark\Entities\Bookmark;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;

class Ad extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $user = User::where('api_token', $request->header('authorization'))->first();

        $attrs = [];
        if (isset($this->neighborhood_id))
            $neighborhood = $this->neighborhood->title;
        else
            $neighborhood = '';
        foreach ($this->attributes as $key => $attribute) {
            if ($attribute->attribute_type == 'select') {
                $attrs[$key]['id'] = $attribute->id;
                $attrs[$key]['title'] = $attribute->title;
                $attrs[$key]['attribute_type'] = $attribute->attribute_type;
                $attrs[$key]['unit'] = isset($attribute->unit) ? $attribute->unit : '';
                $attrs[$key]['value'] = AttributeItem::where('id', $attribute->pivot->attribute_item_id)->first()->title;
                $attrs[$key]['isSignificant'] = $attribute->isSignificant;
            } else {
                $attrs[$key]['id'] = $attribute->id;
                $attrs[$key]['title'] = $attribute->title;
                $attrs[$key]['attribute_type'] = $attribute->attribute_type;
                $attrs[$key]['unit'] = isset($attribute->unit) ? $attribute->unit : '';
                $attrs[$key]['value'] = $attribute->pivot->value;
                $attrs[$key]['isSignificant'] = $attribute->isSignificant;
            }
        }
        if ($user) {
            if (Bookmark::where('ad_id', $this->id)->where('user_id', $user->id)->first()) {
                if (Bookmark::where('ad_id', $this->id)->where('user_id', $user->id)->first()->status == 1)
                    $bookmark = 1;
                else
                    $bookmark = 0;
            } else
                $bookmark = 0;
        }else
            $bookmark = 0;

        $hologram = ['hasHologram' => 0, 'hologramLogo' => ''];
        if (HologramInterface::where('type_id', $this->id)->where('type', 'ad')->first()
            && HologramInterface::where('type_id', $this->id)->where('type', 'ad')->first()->status == 'approved') {
            $hologram = ['hasHologram' => 1, 'hologramLogo' => url(HologramInterface::where('type_id', $this->id)->where('type', 'ad')
                ->first()->hologram->logo)];
        }
        $typeOfAdLogo = '';
        if ($this->type == 'emergency') {
            $typeOfAdLogo = url(Setting::where('title', 'emergency_label')->first()->str_value);
        }
        $shopTitle = '';
        $shopLogo = '';
        $shopAddress = '';
        $shopPhone = '';
        $shop = ['slug' => '', 'shopTitle' => '', 'shopLogo' => '', 'shopAddress' => '', 'shopPhone' => ''];
        if ($this->user->hasRole('real-state-administrator') || $this->user->hasRole('real-state-agent')) {
            $isShop = 1;
            if ($this->user->hasRole('real-state-administrator')) {

                $shopTitle = User::find($this->user_id)->shop_title;
                if (isset(User::find($this->user_id)->shop_logo))
                    $logo = User::find($this->user_id)->shop_logo;
                elseif(isset($shop_default_logo))
                    $logo = $shop_default_logo;
                else
                    $logo=null;
                $shopLogo = isset($logo)? url($logo): '';
//                isset(User::find($this->user_id)->shop_logo)?url(User::find($this->user_id)->shop_logo):'';
                $shopAddress = isset(User::find($this->user_id)->shop_address)?User::find($this->user_id)->shop_address:'';
                $shopPhone = isset(User::find($this->user_id)->shop_phone)?User::find($this->user_id)->shop_phone:'';
                $shopSlug = User::find($this->user_id)->slug;
                $shop = ['slug' => $shopSlug, 'shopTitle' => $shopTitle, 'shopLogo' => $shopLogo, 'shopAddress' => $shopAddress, 'shopPhone' => $shopPhone];

            } elseif ($this->user->hasRole('real-state-agent')) {
                $shopTitle = User::find(User::find($this->user_id)->real_estate_admin_id)->shop_title;
                if (isset(User::find(User::find($this->user_id)->real_estate_admin_id)->shop_logo))
                    $logo = User::find(User::find($this->user_id)->real_estate_admin_id)->shop_logo;
                elseif(isset($shop_default_logo))
                    $logo = $shop_default_logo;
                else
                    $logo=null;
                $shopLogo = isset($logo)? url($logo): '';

//                $shopLogo = isset(User::find(User::find($this->user_id)->real_estate_admin_id)->shop_logo)?url(User::find(User::find($this->user_id)->real_estate_admin_id)->shop_logo):'';
                $shopAddress = isset(User::find(User::find($this->user_id)->real_estate_admin_id)->shop_address)?User::find(User::find($this->user_id)->real_estate_admin_id)->shop_address:'';
                $shopPhone = isset(User::find(User::find($this->user_id)->real_estate_admin_id)->shop_phone)?User::find(User::find($this->user_id)->real_estate_admin_id)->shop_phone:'';
                $shopSlug = User::find(User::find($this->user_id)->real_estate_admin_id)->slug;
                $shop = ['slug' => $shopSlug, 'shopTitle' => $shopTitle, 'shopLogo' => $shopLogo, 'shopAddress' => $shopAddress, 'shopPhone' => $shopPhone];
            }
        } else $isShop = 0;
        if ($this->active == 'delete')
            $active = ' حذف توسط کاربر';
        elseif ($this->active == 'inactive')
            $active = ' در انتظار تایید';
        elseif ($this->active == 'active')
            $active = 'تایید شده';

        return [
            'id' => $this->id,
            'title' => $this->title,
            'city' => $this->city->title,
            'neighborhood' => $neighborhood,
            'codeOfAd' => $this->uniqueCodeOfAd,
            'type' => $this->type,
            'advertiser' => $this->advertiser,
            'mobile' => $this->user->phoneNumberForAds,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'description' => $this->description,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'userStatusOfAd' => $this->userStatus,
            'active' => $this->active,
            'images' => new AdImageCollection($this->adImages),
            'video' => new AdVideoCollection($this->adVideos),
            'attributes' => $attrs,
            'listOfCategories' => $this->category->createStringAsParents2($this->category->path),
            'isBookmark' => $bookmark,
            'hologram' => $hologram,
            'emergencyLogo' => ($typeOfAdLogo),
            'isShop' => $isShop,
            'shop' => $shop,
            'firstName' => $this->user->name,
            'lastName' => $this->user->sirName,
            'adStatus' => $active,
            'paymentStatus' => $this->isPaid,
            'link' => route('ad.show.supplier.user', $this->id),
        ];
    }
}

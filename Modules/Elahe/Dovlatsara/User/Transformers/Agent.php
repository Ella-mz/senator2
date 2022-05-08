<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\Setting\Entities\Setting;

class Agent extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $hologram = ['hasHologram'=>0, 'hologramLogo'=>''];
        if (HologramInterface::where('type_id', $this->id)->where('type', 'user')->first()
            && HologramInterface::where('type_id', $this->id)->where('type', 'user')->first()->status=='approved'){
            $hologram=['hasHologram'=>1, 'hologramLogo'=>url(HologramInterface::where('type_id', $this->id)->where('type', 'user')
                ->first()->hologram->logo)];
        }
        $user_default_photo = Setting::where('title', 'user_default_photo')->first()->str_value;
        if (isset($this->userImage))
            $image = $this->userImage;
        else
            $image = $user_default_photo;
        return [
            'id' => $this->id,
            'firstName' => $this->name,
            'lastName' => $this->sirName,
            'userImage' => url($image),
            'title' => $this->shop_title,
            'slug' => $this->slug,
            'mobile' => $this->mobile,
//            'city' => $this->city->title,
//            'neighborhood' => $neighborhood,
            'description' => $this->shop_description,
//            'shopImage'=>url($shop_default_photo),
            'hologram'=>$hologram,
        ];
    }
}

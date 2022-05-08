<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Setting\Entities\Setting;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $user_default_photo = Setting::where('title', 'user_default_photo')->first()->str_value;
        if (isset($this->userImage))
            $image = $this->userImage;
        else
            $image = $user_default_photo;

        return [
            'id' => $this->id,
            'firstName' => $this->name,
            'lastName' => $this->sirName,
            'userImage' => $this->when(isset($image), url($image), ''),
//            'title' => $this->shop_title,
            'slug' => $this->slug,
            'mobile' => $this->mobile,
//            'city' => $this->city->title,
//            'neighborhood' => $neighborhood,
//            'description' => $this->shop_description,
//            'shopImage'=>url($shop_default_photo),
//            'hologram'=>$hologram,
        ];
    }
}

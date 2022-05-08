<?php

namespace Modules\User\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ActivityRange\Transformers\ActivityRangeCollection;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdCollection;
use Modules\Category\Transformers\Category;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;

class Shop extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $real_estate_agents = User::where('real_estate_admin_id', $this->id)->get();
        if (isset($this->neighborhood_id))
            $neighborhood = $this->neighborhood->title;
        else
            $neighborhood = '';
        $shop_default_photo = Setting::where('title', 'shop_default_photo')->first()->str_value;
        $shop_default_logo = Setting::where('title', 'shop_default_logo')->first()->str_value;
        if (isset($this->shop_logo))
            $logo = $this->shop_logo;
        elseif (isset($shop_default_logo))
            $logo = $shop_default_logo;
        else
            $logo = null;
        $hologram = ['hasHologram' => 0, 'hologramLogo' => ''];
        if (HologramInterface::where('type_id', $this->id)->where('type', 'user')->first()
            && HologramInterface::where('type_id', $this->id)->where('type', 'user')->first()->status == 'approved') {
            $hologram = ['hasHologram' => 1, 'hologramLogo' => url(HologramInterface::where('type_id', $this->id)->where('type', 'user')
                ->first()->hologram->logo)];
        }
        $whatsapp = '';
        $instagram = '';
        $email = '';
        foreach ($this->socialMedias as $socialMedia) {
            if ($socialMedia->type == 'instagram')
                $instagram = $socialMedia->link;
            if ($socialMedia->type == 'email')
                $email = $socialMedia->link;
            if ($socialMedia->type == 'whatsapp')
                $whatsapp = $socialMedia->link;
        }

        return [
            'id' => $this->id,
            'firstName' => $this->name,
            'lastName' => $this->sirName,
//            'userImage' => $this->when(isset($this->userImage), url($this->userImage), $user_default_photo),
            'title' => $this->shop_title,
            'slug' => $this->slug,
            'phone' => $this->shop_phone,
            'address' => $this->shop_address,
            'website' => $this->shop_website,
            'email' => $email,
            'whatsapp' => $whatsapp,
            'instagram' => $instagram,
            'city' => $this->city->title,
            'neighborhood' => $neighborhood,
            'category' => $this->when(isset($this->category_id), new Category(\Modules\Category\Entities\Category::find($this->category_id)), (object)[]),
            'logo' => $this->when(isset($logo), url($logo), ''),
            'description' => $this->shop_description,
            'shopImage' => $this->when(isset($shop_default_photo), url($shop_default_photo), ''),
            'agents' => new AgentCollection($real_estate_agents),
//            'backgroundPhoto'=> $background_default_photo,
            'hologram' => $hologram,
            'activityRange' => new ActivityRangeCollection($this->activityRanges)

//            'ads'=> [
//                'data'=>new AdCollection($ads),
//                'total' => $ads->total(),
//                'path' => $ads->path(),
//                'perPage' => $ads->perPage(),
//                'currentPage' => $ads->currentPage(),
//                'lastPage' => $ads->lastPage(),]
        ];
    }
}

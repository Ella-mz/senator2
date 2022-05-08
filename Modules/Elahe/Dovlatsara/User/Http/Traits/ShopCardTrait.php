<?php namespace Modules\User\Http\Traits;

use Modules\HologramInterface\Entities\HologramInterface;

trait ShopCardTrait
{
    public function shopCard($shops, $shop_default_photo, $shop_default_logo)
    {
        $content='';
        foreach ($shops as $shop){
            $content.='<div class="store col-xl-3 col-lg-4 col-md-6 col-sm-12 mt-4"><div class="show-store">';
            $content.='<div class="store-img">';
            if(isset($shop_default_photo))
                $content.='<img src="'.asset($shop_default_photo).'" alt="">';
            else
                $content.='<img src="'.asset('files/userMaster/assets/img/download.jpg').'" alt="">';
            $content.='<div class="pro-option"><ul><li class="hologram-img-color">';
            if(HologramInterface::where('type_id', $shop->id)->where('type', 'user')->first()
                && HologramInterface::where('type_id', $shop->id)->where('type', 'user')->first()->status=='approved')
                $content.='<img src="'.asset(HologramInterface::where('type_id', $shop->id)->where('type', 'user')->first()->hologram->logo).'" alt="">';
            $content.='</li></ul></div></div><a href="'.route('realEstate.show.user', $shop->slug).'"><div class="store-desc">';
            $content.='<div class="store-desc-item"><div class="store-desc-item-img"><div class="store-logo">';
            if(isset($shop->shop_logo))
                $content.='<img src="'.asset($shop->shop_logo).'" alt="">';
            elseif (isset($shop_default_logo))
                $content.='<img src="'.asset($shop_default_logo).'" alt="">';
            $content.='</div></div><div class="store-desc-item-intro"><h3>'.$shop->shop_title.'</h3><p class="profile-id">'.$shop->shop_phone.'</p>';
            $content.='<p class="store-place">'.$shop->city->title.'</p> </div> </div> </div></a></div></div>';
        }
        return $content;
    }

    public function shopTag($tags)
    {
        $content='';
        foreach ($tags as $tag){
            $content.='<span class="badge bg-primary mx-2">'.$tag.'</span>';
        }
        return $content;
    }

}

<?php namespace Modules\General\Http\Traits;

use Modules\Attribute\Entities\Attribute;
use Modules\AttributeItem\Entities\AttributeItem;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\Setting\Entities\Setting;

trait SupplierAdCard
{
    public function supplierCard($ads)
    {
        $content = '';
        $ad_default_photo = Setting::where('title', 'ad_default_photo')->first()->str_value;
        $emergency_label = Setting::where('title', 'emergency_label')->first()->str_value;
        foreach ($ads as $ad) {
            $content .= '<div class=" col-xl-3 col-sm-6 mb-5 d-flex justify-content-center flex-column align-items-center">';
            $content .= '<div class="productShowCard"><div class="productShow-img">';
            if (isset($ad->adImages->first()->image)) {
                $content .= '<img src="' . asset($ad->adImages->first()->image) . '" alt="dolatsara">';
            } elseif (isset($ad_default_photo))
                $content .= '<img src="' . asset($ad_default_photo) . '" alt="dolatsara">';
            else
                $content .= '<img src="' . asset('files/userMaster/assets/img/images.jpg') . '" alt="">';
            $content .= '<div class="pro-option"><ul><li class="hologram-img-color">';
            if (HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
                && HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status == 'approved')
                $content .= '<img src="' . asset(HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->hologram->logo) . '" alt=""></li>';
            else
                $content .= '</li>';
            $content .= '<li class="hologram-img-text">';
            if ($ad->type == 'emergency') {
                $content .= '<img src="' . asset($emergency_label) . '" alt="" class="option-img"></li>';
            } else
                $content .= '</li>';
            $content .= '</ul></div></div><div class="productShow-desc"><div class="product-id"><span>کد آگهی: <span>' . $ad->uniqueCodeOfAd . '</span></span>';
            $content .= '</div><div class="productShow-desc-name"><h3>' . $ad->title . '</h3><p>';
            $content .= ($ad->user->shop_active == 'active') ? $ad->user->shop_title : '';
            $content .= '</p></div>';
            $content .= '<div class="productShow-desc-option"><ul><li><div><img src="' . asset('files/userMaster/assets/img/placeholder.png') . '" alt="">';
            $content .= '<span>';
            if (isset($ad->neighborhood_id))
                $content .= $ad->neighborhood->title;
            else
                $content .= $ad->city->title;
            $content .= '</span></div></li>';
            if ($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()) {
                $content .= '<li><div><img src="' . asset('files/userMaster/assets/img/home.png') . '" alt=""><span>';
                $content .= AttributeItem::where('id', $ad->attributes->where('isSignificant', 1)
                        ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)->first()->title . '</span></div></li>';
            }
            $content .= '</ul>';
            $content .= '<a href="' . route('ad.show.supplier.user', $ad->id) . '" class="mainLink"></a>';
            $content .= '</div>';
            $content .= '<div class="productShow-desc-price">';
            if ($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()) {
                if (isset($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)) {
                    $content .= '<p>' . number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value);
                    $content .= ' ' . Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit . '</p>';

                } else {
                    $content .= '<p>' . Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value . '</p>';

                }
            }
            $content .= '</div></div></div></div>';
        }
        return $content;
    }
}

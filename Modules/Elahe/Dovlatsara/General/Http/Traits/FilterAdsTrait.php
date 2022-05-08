<?php

namespace Modules\General\Http\Traits;

trait FilterAdsTrait
{
    public function filterAds($ads, $adAttributes, $adAttributes2, $attributeTypeSelect, $attributeTypeBool, $attributeTypeNumber, $city,
                              $neighborhood, $categoryInForm, $attributeAlt, $adWithImage, $emergencyType)
    {
        if (isset($emergencyType)) {
            $ads = $ads->where('type', 'emergency');
        }

//            if (isset($request->type)) {
//
//                $ads = $ads->where('type', $request->type);
//            }
        if (isset($attributeAlt)) {
            $ads = $this->altFilter($attributeAlt, $adAttributes, $ads);
        }

        if (isset($city)) {

            if ($city != "all")
                $ads = $ads->where('city_id', $city);
        }

        if (isset($neighborhood)) {
            $ads = $ads->whereIn('neighborhood_id', $neighborhood);
        }
        if (isset($attributeTypeSelect)) {

            $ads = $this->selectFilter($attributeTypeSelect, $adAttributes, $ads);
        }
        if (isset($attributeTypeBool)) {
            $ads = $this->boolFilter($attributeTypeBool, $adAttributes, $ads);
        }
        if (isset($attributeTypeNumber)) {
            $ads = $this->numberFilter($attributeTypeNumber, $adAttributes2, $ads);
        }

        if (isset($adWithImage)) {
            $arr = [];
            foreach ($ads->get() as $ad) {
                if (count($ad->adImages) > 0) {
                    array_push($arr, $ad->id);
                }
            }
            $ads = $ads->whereIn('id', $arr);
        }
        return $ads;
    }

}

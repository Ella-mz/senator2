<?php

namespace Modules\AdFee\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdFeeWithTypeOfAdCollection extends ResourceCollection
{
    protected $type;

    public function type($value)
    {
        $this->type=$value;
        return $this;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (AdFeeWithTypeOfAd $adFeeWithTypeOfAd) use ($request){
            return $adFeeWithTypeOfAd->type($this->type)->toArray($request);
        })->all();
//        return parent::toArray($request);
    }
}

<?php

namespace Modules\Advertising\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class Page extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'title'=>$this->fa_title,
            'location'=>new AdvertisingOrderCollection($this->advertisingOrders),
        ];
    }
}

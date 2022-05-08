<?php

namespace Modules\Advertising\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AdvertisingOrder extends JsonResource
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
            'image'=>$this->when(isset($this->image), url($this->image),''),
            'description'=>$this->when(isset($this->description), $this->description, ''),
            'advertising'=>new AdvertisingCollection($this->advertisings->where('active', 1))
        ];
    }
}

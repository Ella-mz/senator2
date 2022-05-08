<?php

namespace Modules\ActivityRange\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\City\Transformers\City;
use Modules\City\Transformers\CityCollection;
use Modules\Neighborhood\Transformers\Neighborhood;

class ActivityRange extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $city = [];
        $city['id']=$this->city->id;
        $city['title']=$this->city->title;
        return [
            'city'=>$city,
            'neighborhood'=>$this->when(isset($this->neighborhood), new Neighborhood($this->neighborhood), (object)[]),
        ];
//        return parent::toArray($request);
    }
}

<?php

namespace Modules\City\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Neighborhood\Transformers\NeighborhoodCollection;

class City extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'neighborhoods'=>new NeighborhoodCollection($this->neighborhoods)
        ];
    }
}

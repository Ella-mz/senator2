<?php

namespace Modules\Neighborhood\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class Neighborhood extends JsonResource
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
            'geographicalDirection'=>$this->geographicalDirection,
        ];
    }
}

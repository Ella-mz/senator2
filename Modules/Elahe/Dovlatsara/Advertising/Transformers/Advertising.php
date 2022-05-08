<?php

namespace Modules\Advertising\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class Advertising extends JsonResource
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
            'id'=>$this->id,
            'title'=>$this->title,
            'price'=>$this->price,
            'description'=>$this->description,
        ];
    }
}

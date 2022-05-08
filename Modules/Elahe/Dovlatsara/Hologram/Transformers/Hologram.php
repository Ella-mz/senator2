<?php

namespace Modules\Hologram\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class Hologram extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'title'=>$this->title,
            'logo'=>$this->when(isset($this->logo), url($this->logo), ''),
            'price'=>$this->price,
            'description'=>$this->when(isset($this->description), $this->description, ''),
        ];
    }
}

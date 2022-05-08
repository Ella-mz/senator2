<?php

namespace Modules\AdImageNew\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AdImage extends JsonResource
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
            'image' => url($this->image),
        ];
    }
}

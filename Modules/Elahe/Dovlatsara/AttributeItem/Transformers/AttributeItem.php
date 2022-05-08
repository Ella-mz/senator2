<?php

namespace Modules\AttributeItem\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AttributeItem extends JsonResource
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

        ];
    }
}

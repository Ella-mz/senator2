<?php

namespace Modules\GroupAttribute\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Attribute\Transformers\AttributeCollection;

class GroupAttribute extends JsonResource
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
            'title' => $this->when($this->hidden==0, $this->title, ''),
            'type' => $this->type,
            'attributes' => new AttributeCollection($this->attributes->where('isFilterField', 1)),

        ];
    }
}

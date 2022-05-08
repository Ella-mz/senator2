<?php

namespace Modules\GroupAttribute\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GroupAttributeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

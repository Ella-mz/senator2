<?php

namespace Modules\Ad\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdVideoCollection extends ResourceCollection
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

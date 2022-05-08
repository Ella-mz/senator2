<?php

namespace Modules\HologramInterface\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HologramInterfaceCollection extends ResourceCollection
{
    protected $type;

    public function type($value)
    {
        $this->type=$value;
        return $this;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (HologramInterface $hologram) use ($request){
            return $hologram->type($this->type)->toArray($request);
        })->all();
    }
}

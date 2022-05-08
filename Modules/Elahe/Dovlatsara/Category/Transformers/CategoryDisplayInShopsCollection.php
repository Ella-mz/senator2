<?php

namespace Modules\Category\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryDisplayInShopsCollection extends ResourceCollection
{
    protected $adsCount;
    protected $adsPercent;

    public function foo($adsCount, $adsPercent){
        $this->adsCount = $adsCount;
        $this->adsPercent = $adsPercent;
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
        return $this->collection->map(function (CategoryDisplayInShops $resource) use ($request){
            return $resource->foo($this->adsCount, $this->adsPercent)->toArray($request);
        })->all();
    }
}

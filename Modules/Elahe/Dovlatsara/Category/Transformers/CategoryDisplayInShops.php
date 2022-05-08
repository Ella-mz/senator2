<?php

namespace Modules\Category\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryDisplayInShops extends JsonResource
{
    protected $adsCount;
    protected $adsPercent;

    public function foo($adsCount, $adsPercent)
    {
        $this->adsCount = $adsCount;
        $this->adsPercent = $adsPercent;
        return $this;
    }
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
            'isNode'=> $this->node,
            'image'=>$this->when(isset($this->image), url($this->image), ''),
            'adsCount' => $this->adsCount,
            'adsPercent' => $this->adsPercent,
        ];
    }

    public static function collection($resource)
    {
        return new CategoryDisplayInShopsCollection($resource);
    }
}

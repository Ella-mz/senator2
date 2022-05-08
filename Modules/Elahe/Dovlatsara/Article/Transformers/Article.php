<?php

namespace Modules\Article\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'shortDescription' => $this->shortDescription,
            'description' => $this->description,
            'viewCount' => $this->view,
            'image' => $this->when(isset($this->image), url($this->image), ''),
            'groupTitle'=>$this->group->title,
            'created_at'=>$this->created_at->toDateString()
        ];
    }
}

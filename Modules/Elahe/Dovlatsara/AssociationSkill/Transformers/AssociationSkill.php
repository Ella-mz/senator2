<?php

namespace Modules\AssociationSkill\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AssociationSkill extends JsonResource
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
            'image'=>$this->when(isset($this->image), url($this->image), '')
        ];
    }
}

<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractorProject extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->contractorProjectImages->first())
            $image = url($this->contractorProjectImages->first()->image);
        else
            $image = '';
        return [
            'title' => $this->title,
            'description' => $this->description,
            'image'=>$image
        ];
    }
}

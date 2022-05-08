<?php

namespace Modules\EnumType\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class HeaderIcon extends JsonResource
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
            'icon'=>$this->when(isset($this->image), url($this->image), ''),
            'link' => $this->when(isset($this->link), $this->link, '')
        ];
    }
}

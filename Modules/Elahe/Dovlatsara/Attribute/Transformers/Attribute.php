<?php

namespace Modules\Attribute\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AttributeItem\Transformers\AttributeItemCollection;

class Attribute extends JsonResource
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
            'attribute_type' => $this->attribute_type,
            'unit'=>$this->when(isset($this->unit), $this->unit, ''),
            'hasScale'=>$this->hasScale,
            'isSignificant'=>$this->isSignificant,
            'required'=>$this->isFilterField,
            'placeHolder'=>$this->when(isset($this->placeHolder), $this->placeHolder, ''),
            'items'=>$this->when($this->attribute_type=='select', new AttributeItemCollection($this->attributeItems), [])
        ];
    }
}

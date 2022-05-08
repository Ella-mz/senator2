<?php

namespace Modules\Advertising\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Entities\Category;

class AdvertisingAppliaction extends JsonResource
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
            'name'=>$this->userInfo->name,
            'sirName'=>$this->userInfo->sirName,
            'advertising'=>new Advertising($this->advertising),
            'link'=> $this->link,
            'image'=>$this->when(isset($this->image), url($this->image), ''),
            'imageTitle'=>$this->when(isset($this->image_title), ($this->image_title), ''),
            'responsiveImage'=>$this->when(isset($this->responsive_image), url($this->responsive_image), (isset($this->image)? url($this->image): '')),
            'responsiveImageTitle'=>$this->when(isset($this->responsive_image), ($this->responsive_image_title), ''),
            'startDate'=>$this->startDate,
            'endDate'=>$this->endDate,
            'category'=>$this->when(isset($this->category), new \Modules\Category\Transformers\Category($this->category1), (object)[]),
            'active'=>$this->active,
            'created_at'=>$this->created_at->toDateTimeString(),
            'position'=>$this->advertising->advertisingOrder->page->fa_title.','.$this->advertising->advertisingOrder->fa_title
        ];
    }
}

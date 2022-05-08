<?php

namespace Modules\Advertising\Transformers;

use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Category\Transformers\Category;

class AdvertisingApplicationShow extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
//        dd($this->startDate, Verta::now()->startMonth(), Verta::now()->startMonth() ==$this->startDate, $this->endDate <= Verta::now()->endMonth(), $this->endDate > Verta::now()->startMonth() );
//        $flage = 0;
//        if ($this->startDate <= Verta::now()->startMonth()
//            && $this->endDate <= Verta::now()->endMonth()
//            && $this->endDate > Verta::now()->startMonth()) {
//            $flage = 1;
//        }
//        if ($flage == 1)
            return [
                'id' => $this->id,
//            'sirName'=>$this->user->sirName,
//            'advertising'=>new Advertising($this->advertising),
                'link' => $this->link,
                'image' =>  $this->when(isset($this->image), url($this->image), ''),
                'responsiveImage' =>  $this->when(isset($this->image), url($this->image), ''),
//            'imageTitle'=>$this->when(isset($this->image_title), ($this->image_title), ''),
//            'startDate'=>$this->startDate,
//            'endDate'=>$this->endDate,
                'category' => $this->when(isset($this->category), new Category($this->category1), (object)[]),
//            'active'=>$this->active,
//            'create_at'=>$this->created_at->toDateTimeString(),
//            'position'=>$this->advertising->advertisingOrder->page->fa_title.','.$this->advertising->advertisingOrder->fa_title
            ];
//        else{
//            return null;
//        }
    }
}

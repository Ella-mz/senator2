<?php

namespace Modules\Application\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AttributeItem\Entities\AttributeItem;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\Neighborhood\Transformers\NeighborhoodCollection;

class Application extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */

    public function toArray($request)
    {
        if ($this->attributes->count()<=0)
            $attrs=[];
        foreach ($this->attributes as $key => $attribute) {
            if ($attribute->attribute_type == 'select') {
                if ($attribute->hasScale == 1) {
                    $attrs[$key]['id'] = $attribute->id;
                    $attrs[$key]['title'] = $attribute->title;
                    $attrs[$key]['attribute_type'] = $attribute->attribute_type;
                    $attrs[$key]['unit'] = isset($attribute->unit) ? $attribute->unit : '';
                    $attrs[$key]['value1'] = AttributeItem::where('id', $attribute->pivot->attribute_item_id1)->first()->title;
                    $attrs[$key]['value2'] = AttributeItem::where('id', $attribute->pivot->attribute_item_id2)->first()->title;
                    $attrs[$key]['isSignificant'] = $attribute->isSignificant;
                    $attrs[$key]['hasScale'] = $attribute->hasScale;
                } else {
                    $attrs[$key]['id'] = $attribute->id;
                    $attrs[$key]['title'] = $attribute->title;
                    $attrs[$key]['attribute_type'] = $attribute->attribute_type;
                    $attrs[$key]['unit'] = isset($attribute->unit) ? $attribute->unit : '';
                    $attrs[$key]['value1'] = AttributeItem::where('id', $attribute->pivot->attribute_item_id1)->first()->title;
                    $attrs[$key]['value2'] = '';
                    $attrs[$key]['isSignificant'] = $attribute->isSignificant;
                    $attrs[$key]['hasScale'] = $attribute->hasScale;
                }
            } elseif ($attribute->attribute_type == 'int') {
                if ($attribute->hasScale == 1) {
                    $attrs[$key]['id'] = $attribute->id;
                    $attrs[$key]['title'] = $attribute->title;
                    $attrs[$key]['attribute_type'] = $attribute->attribute_type;
                    $attrs[$key]['unit'] = isset($attribute->unit) ? $attribute->unit : '';
                    $attrs[$key]['value1'] = $attribute->pivot->value1;
                    $attrs[$key]['value2'] = $attribute->pivot->value2;
                    $attrs[$key]['isSignificant'] = $attribute->isSignificant;
                    $attrs[$key]['hasScale'] = $attribute->hasScale;
                } else {
                    $attrs[$key]['id'] = $attribute->id;
                    $attrs[$key]['title'] = $attribute->title;
                    $attrs[$key]['attribute_type'] = $attribute->attribute_type;
                    $attrs[$key]['unit'] = isset($attribute->unit) ? $attribute->unit : '';
                    $attrs[$key]['value1'] = $attribute->pivot->value1;
                    $attrs[$key]['value2'] = '';
                    $attrs[$key]['isSignificant'] = $attribute->isSignificant;
                    $attrs[$key]['hasScale'] = $attribute->hasScale;
                }
            } else {
                $attrs[$key]['id'] = $attribute->id;
                $attrs[$key]['title'] = $attribute->title;
                $attrs[$key]['attribute_type'] = $attribute->attribute_type;
                $attrs[$key]['unit'] = isset($attribute->unit) ? $attribute->unit : '';
                $attrs[$key]['value1'] = $attribute->pivot->value1;
                $attrs[$key]['value2'] = '';
                $attrs[$key]['isSignificant'] = $attribute->isSignificant;
                $attrs[$key]['hasScale'] = $attribute->hasScale;
            }
        }
        $neigborhoods=[];
        foreach ($this->neighborhoods as $neighbor){
            array_push($neigborhoods, Neighborhood::find($neighbor->neighborhood_id));
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'city' => $this->city->title,
            'neighborhood' => new NeighborhoodCollection($neigborhoods),
            'phone' => $this->phone,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'firstName' => $this->user->name,
            'lastName' => $this->user->sirName,
            'active' => $this->active,
            'attributes' => $attrs,
            'listOfCategories' => $this->category->createStringAsParents2($this->category->path),
            'description' => $this->description,
        ];
    }
}

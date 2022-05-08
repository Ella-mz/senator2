<?php

namespace Modules\AdFee\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdFeeWithTypeOfAd extends JsonResource
{
    protected $type;

    public function type($value)
    {
        $this->type=$value;
        return $this;
    }
    /**
     * Transform the resource into an array.
     *
     * @param  Request
     * @return array
     */

    public function toArray($request)
    {
        if ($this->type=='general')
            $fee = $this->generalAdFee;
        elseif ($this->type == 'scalar')
            $fee = $this->scalarAdFee;
        elseif ($this->type == 'special')
            $fee = $this->specialAdFee;
        elseif ($this->type == 'emergency')
            $fee = $this->emergencyAdFee;
        return [
            'id' => $this->id,
            'duration' => $this->expireTimeOfAds,
            'fee' => $fee,
//            'scalarAdFee' => $this->scalarAdFee,
//            'specialAdFee' => $this->specialAdFee,
//            'emergencyAdFee' => $this->emergencyAdFee,
        ];
    }

    public static function collection($resource)
    {
        return new AdFeeWithTypeOfAdCollection($resource);
    }
}

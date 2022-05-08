<?php

namespace Modules\AdFee\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class AdFee extends JsonResource
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
            'duration' => $this->expireTimeOfAds,
            'generalAdFee' => $this->generalAdFee,
            'scalarAdFee' => $this->scalarAdFee,
            'specialAdFee' => $this->specialAdFee,
            'emergencyAdFee' => $this->emergencyAdFee,
        ];
    }
}

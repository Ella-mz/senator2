<?php

namespace Modules\HologramInterface\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Ad\Transformers\Ad;
use Modules\Hologram\Transformers\Hologram;
use Modules\User\Transformers\User;

class HologramInterface extends JsonResource
{
    protected $type;

    public function type($value)
    {
        $this->type = $value;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->type=='ad')
            $typeInfo = new Ad(\Modules\Ad\Entities\Ad::find($this->type_id));
        elseif ($this->type == 'user')
            $typeInfo = new User(\Modules\User\Entities\User::find($this->type_id));
        else
            $typeInfo = (object)[];
        return [
            'id'=>$this->id,
            'status'=>$this->status,
            'price'=>$this->hologram_price,
            'typeInfo'=>$typeInfo,
            'expert_description' => $this->when(isset($this->expert_description), $this->expert_description, ''),
            'expert_answer_time'=>$this->when(isset($this->expert_answer_time), $this->expert_answer_time, ''),
            'hologram'=>new Hologram($this->hologram)
        ];
    }

    public static function collection($resource)
    {
        return new HologramInterfaceCollection($resource);
    }
}

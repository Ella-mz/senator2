<?php

namespace Modules\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\ActivityRange\Transformers\ActivityRangeCollection;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\Setting\Entities\Setting;

class ContractorShow extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $contractor_men_default_photo = Setting::where('title', 'contractor_men_default_photo')->first()->str_value;
        $contractor_women_default_photo = Setting::where('title', 'contractor_women_default_photo')->first()->str_value;
        $background_default_photo = Setting::where('title', 'contractors_default_photo_in_app')->first()->str_value;
        if (isset($this->userImage))
            $image = $this->userImage;
        elseif($this->sex==1)
            $image = $contractor_women_default_photo;
        else
            $image = $contractor_men_default_photo;

        $hologram = ['hasHologram'=>0, 'hologramLogo'=>''];
        if (HologramInterface::where('type_id', $this->id)->where('type', 'user')->first()
            && HologramInterface::where('type_id', $this->id)->where('type', 'user')->first()->status=='approved'){
            $hologram=['hasHologram'=>1, 'hologramLogo'=>url(HologramInterface::where('type_id', $this->id)->where('type', 'user')
                ->first()->hologram->logo)];
        }
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'firstName' => $this->name,
            'lastName' => $this->sirName,
            'userImage' => url($image),
            'contractorCode' => $this->user_id,
            'mobile' => $this->mobile,
            'yearOfOperation' =>$this->when(isset( $this->yearOfOperation), $this->yearOfOperation, ''),
            'numberOfSkills' => $this->associationSkills->count(),
            'numberOfProjects' => $this->contractorProjects->count(),
            'slug' => $this->slug,
            'skills' => new ContractorSkillCollection($this->associationSkills),
            'projects'=> new ContractorProjectCollection($this->contractorProjects),
            'unions'=> new AssociationCollection($this->associations),
//            'backgroundPhoto'=> $background_default_photo,
            'hologram'=>$hologram,
            'activityRange'=>new ActivityRangeCollection($this->activityRanges)

        ];
    }
}

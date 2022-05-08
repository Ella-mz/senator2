<?php namespace Modules\User\Http\Traits;

use Modules\HologramInterface\Entities\HologramInterface;
use Modules\Setting\Entities\Setting;

trait ContractorCardTrait
{
    public function contractorCard($contractors)
    {
        $contractor_men_default_photo = Setting::where('title', 'contractor_men_default_photo')->first()->str_value;
        $contractor_women_default_photo = Setting::where('title', 'contractor_women_default_photo')->first()->str_value;

        $content = '';
        foreach ($contractors as $contractor) {
            $content .= '<div class="item col-xl-3 col-lg-4 col-md-6 col-sm-12">';
            $content .= '<div class="show-contractor-parent"><div class="show-contractor"><div class="show-contractor-content">';
            $content .= '<div class="show-contractor-content-desc"><div class="contractor-img">';
            if (isset($contractor->userImage)) {
                $content .= '<img src="' . asset($contractor->userImage) . '" alt="">';
            } elseif ($contractor->sex == 1)
                $content .= '<img src="' . asset($contractor_women_default_photo) . '" alt="">';
            else
                    $content .= '<img src="' . asset($contractor_men_default_photo) . '" alt="">';
            $content .= '</div><a href="' . route('contractors.show.user', $contractor->slug) . '">';
            $content .= '<div class="contractor-intro"><div class="contractor-name d-flex justify-content-between px-3 mt-3">';
            $content .= '<h3>' . $contractor->name . ' ' . $contractor->sirName . '</h3><p>' . $contractor->user_id . '</p>' . '</div>';
            $content .= '<div class="contractore-job d-flex justify-content-between px-3 mt-3"><p>';
            if ($contractor->associations()->count() > 0) {
                $content .= $contractor->associations()->first()->title;
            }
            $content .= '</p><p>';
            if ($contractor->associations()->count() > 1) {
                $content .= $contractor->associations()->skip(1)->first()->title;
            }
            $content .= '</p></div></div>';
            $content .= '<div class="contractor-profile d-flex justify-content-between px-5 mt-1"><p>' . $contractor->associationSkills->count() . ' مهارت</p>';
            $content .= '<p>' . $contractor->contractorProjects->count() . ' پروژه</p></div>';
            if (HologramInterface::where('type_id', $contractor->id)->where('type', 'user')->first()
                && HologramInterface::where('type_id', $contractor->id)->where('type', 'user')->first()->status == 'approved') {
                $content .= '<div class="contractor-hologram"><ul> <li class="hologram-img-color">';
                $content .= '<img src="' . asset(HologramInterface::where('type_id', $contractor->id)->where('type', 'user')->first()->hologram->logo) . '" alt="">';
                $content .= ' </li></ul></div>';
            }
            $content .= '</a></div></div></div></div></div>';
        }
        return $content;
    }

    public function shopTag($tags)
    {
        $content = '';
        foreach ($tags as $tag) {
            $content .= '<span class="badge bg-primary mx-2">' . $tag . '</span>';
        }
        return $content;
    }

}

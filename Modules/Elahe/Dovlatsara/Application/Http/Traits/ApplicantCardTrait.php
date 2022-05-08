<?php namespace Modules\Application\Http\Traits;

use Modules\AttributeItem\Entities\AttributeItem;
use Modules\Category\Entities\Category;
use Modules\Neighborhood\Entities\Neighborhood;

trait ApplicantCardTrait
{

    public function applicantCard($applications)
    {
        $content = '';
        foreach ($applications as $key => $application) {
            $content .= '<div class="col-lg-6 mb-4"><div class="request-card"><div class="request-title"><p>' . $application->title . '</p></div>';
            $content .= '<div class="request-save d-flex align-items-center justify-content-between mt-2"><ul class="request-tags">';
            $content .= '<ul class="request-tags">' . Category::where('id', $application->category_id)->first()->createStringAsParents3() . '</ul>';
            $content .= '<div class="bookmark"></div></div><ul class="request-main-info"><li><P class="request-info-title">شهر :</P>';
            $content .= '<p class="request-main-info-data">' . $application->city->title . '</p></li><li>';
            $content .= '<P class="request-info-title">تاریخ درخواست :</P><p class="request-main-info-data">';
            $content .= verta($application->startDate)->formatJalaliDate() . '</p></li><li>';
            if ($application->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()) {
                $content .= '<P class="request-info-title">' . $application->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()->title;
                $content .= ' :</P>';
                if ($application->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()->hasScale) {
                    $content .= '<p class="request-main-info-data">' . AttributeItem::where('id', $application->attributes->where('isSignificant', 1)
                            ->where('attribute_type', 'select')->first()->pivot->attribute_item_id1)
                            ->first()->title . '-' . AttributeItem::where('id', $application->attributes->where('isSignificant', 1)
                            ->where('attribute_type', 'select')->first()->pivot->attribute_item_id2)
                            ->first()->title . '</p>';
                } else {
                    $content .= '<p class="request-main-info-data">' . AttributeItem::where('id', $application->attributes->where('isSignificant', 1)
                            ->where('attribute_type', 'select')->first()->pivot->attribute_item_id1)
                            ->first()->title . '</p>';
                }
            }
            $content .= '</li><li>';
            if ($application->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()) {
                $content .= '<P class="request-info-title">' . $application->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->title;
                $content .= ' :</P>';
                if ($application->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->hasScale) {
                    $content .= '<p class="request-main-info-data">' . number_format($application->attributes->where('isSignificant', 1)
                            ->where('attribute_type', 'int')->first()->pivot->value1) . '-' . number_format($application->attributes->where('isSignificant', 1)
                            ->where('attribute_type', 'int')->first()->pivot->value2) . ' ' . $application->attributes->where('isSignificant', 1)
                            ->where('attribute_type', 'int')->first()->unit . '</p>';
                } else {
                    $content .= '<p class="request-main-info-data">' . number_format($application->attributes->where('isSignificant', 1)
                            ->where('attribute_type', 'int')->first()->pivot->value1) . ' ' . $application->attributes->where('isSignificant', 1)
                            ->where('attribute_type', 'int')->first()->unit . '</p>';
                }
            }
            $content .= '</li></ul><div class="accordion-item">';
            $content .= '<div id="collapse' . $key . '" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">';
            $content .= '<div class="accordion-body">';
            if ($application->attributes->count() > 0) {
                $content .= '<ul class="request-minor-info">';
                foreach ($application->attributes as $attribute) {
                    if ($attribute->attribute_type == 'int') {
                        if ($application->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()
                            && $application->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id != $attribute->id) {
                            $content .= '<li><P class="request-info-title">' . $attribute->title . ' :</P><p class="request-minor-info-data">';
                            if (isset($attribute->pivot->value2)) {
                                $content .= '<span>' . number_format($attribute->pivot->value1) . '</span><span>  تا ' . number_format($attribute->pivot->value2) . '</span>' . $attribute->unit;
                            } else {
                                $content .= '<span>' . number_format($attribute->pivot->value1) . ' ' . $attribute->unit;
                            }
                            $content .= '</p></li>';
                        }
                    } elseif ($attribute->attribute_type == 'select') {
                        if ($application->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()
                            && $application->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()->id != $attribute->id) {
                            $content .= '<li><P class="request-info-title">' . $attribute->title . ' :</P><p class="request-minor-info-data">';
                            if (isset($attribute->pivot->attribute_item_id2)) {
                                $content .= AttributeItem::where('id', $attribute->pivot->attribute_item_id1)
                                        ->first()->title . '-' . AttributeItem::where('id', $attribute->pivot->attribute_item_id2)
                                        ->first()->title;
                            } else {
                                $content .= AttributeItem::where('id', $attribute->pivot->attribute_item_id1)
                                    ->first()->title;
                            }
                            $content .= '</p></li>';
                        }
                    } elseif ($attribute->attribute_type == 'string') {
                        $content .= '<li><P class="request-info-title">' . $attribute->title . ' :</P><p class="request-minor-info-data">';
                        $content .= '<span>' . $attribute->pivot->value1 . ' ' . $attribute->unit . '</span></p></li>';
                    } elseif ($attribute->attribute_type == 'bool') {
                        $content .= '<li><P class="request-info-title">' . $attribute->title . ' :</P><p class="request-minor-info-data">';
                        $content .= '<span><i class="fa fa-check"></i></span></p></li>';
                    }
                }
                $content .= '<li><P class="request-info-title">محله:</P><p class="request-minor-info-data">';
                if (($application->neighborhoods()->count() > 0)) {
                    foreach ($application->neighborhoods as $neighborhood) {
                        $content .= Neighborhood::find($neighborhood->neighborhood_id)->title . '/';
                    }
                }
                $content .= '</p></li></ul>';
            }
            $content .= '<div class="extra-info"><P class="request-info-title">توضیحات :</P><div class="textarea"><p>' . $application->description . '</p></div></div>';
            $content .= '<div class="contact-call-info"><button data-bs-toggle="collapse" data-bs-target="#multiCollapseExample' . $key . '" aria-expanded="false" aria-controls="multiCollapseExample' . $key . '">اطلاعات تماس';
            $content .= '</button><div class="collapse multi-collapse" id="multiCollapseExample' . $key . '"><div class="card card-body"><div class="request-contact-info">';
            $content .= '<p>' . $application->user->name . ' ' . $application->user->sirName . '</p>' . '<p>' . $application->phone . '</p></div></div></div></div></div></div>';
            $content .= '<h2 class="accordion-header" id="heading' . $key . '"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" ';
            $content .= 'data-bs-target="#collapse' . $key . '" aria-expanded="false" aria-controls="collapse' . $key . '">اطلاعات بیشتر </button>';
            $content .= '</h2></div></div></div>';
        }
        return $content;
    }

}

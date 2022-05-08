<?php

namespace Modules\Recentseen\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\ApplicantMembership\Entities\ApplicantMembership;
use Modules\Application\Entities\Application;
use Modules\Application\Entities\ApplicationNeighborhood;
use Modules\Application\Http\Traits\StoreApplicationTrait;
use Modules\Application\Repositories\ApplicationRepository;
use Modules\Attribute\Entities\Attribute;
use Modules\AttributeItem\Entities\AttributeItem;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Entities\City;
use Modules\CommonQuestion\Entities\CommonQuestion;
use Modules\GroupAttribute\Entities\GroupAttribute;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\Recentseen\Entities\ApplicationRecentseen;
use Modules\Recentseen\Repository\ApplicationRecentSeenRepository;
use RealRashid\SweetAlert\Facades\Alert;

class ApplicationRecentseenController extends Controller
{
    use StoreApplicationTrait;

    private $applicationRecentSeenRepository;
    private $categoryRepository;

    public function __construct(ApplicationRecentSeenRepository $applicationRecentSeenRepository, CategoryRepository $categoryRepository)
    {
        $this->applicationRecentSeenRepository = $applicationRecentSeenRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $cats = null;
        $attributeGroups = null;
        $category1 = null;
        $application_ids = ApplicationRecentseen::where('user_id', \auth()->id())->where('isSeen', 1)->pluck('application_id')->toArray();
//        $applications = $this->applicationRecentSeenRepository->getApplicationByApplicationIds($application_ids);

        if (isset($request->category))
            $category1 = $this->applicationRecentSeenRepository->findCategoryById($request->category);
        if ($category1) {
            $childCats = $this->getLastNodewithItself($category1);
            $cats = $this->applicationRecentSeenRepository->nodeCatsWithIds($childCats)->pluck('id')->toArray();
            $attributeGroups = $this->getAttributeGroups($category1->id, 'applicant');
        }
        if ($cats)
            $applications = $this->applicationRecentSeenRepository->applicationsForPanelWithCats($cats, $application_ids);
        else
            $applications = $this->applicationRecentSeenRepository->applicationsForPanelByApplicationId($application_ids);
//        $application_ids = $applications->pluck('id');
        $applicationAttributes = $this->applicationRecentSeenRepository->applicationAttributeWithApplicationIds($application_ids);
        $applicationAttributes2 = $this->applicationRecentSeenRepository->applicationAttributeWithapplicationIds($application_ids);
        if ((isset($request->attributeTypeSelect) || isset($request->attributeTypeBool) || isset($request->attributeTypeNumber)
            || isset($request->attributeTypeSelect2) || isset($request->attributeTypeBool2) || isset($request->city) ||
            isset($request->attributeTypeNumber2) || isset($request->cityModal) || isset($request->neighborhoodModal)
            || isset($request->neighborhood) || isset($request->categoryInForm)
            || isset($request->categoryInFormModal))) {
            if (isset($request->city)) {
                if ($request->city == "all") {
                    $city_ids = $this->applicationRecentSeenRepository->cities()->pluck('id')->toArray();

                    $applications = $applications->whereIn('city_id', $city_ids);

                } else
                    $applications = $applications->where('city_id', $request->city);
            }
            if (isset($request->cityModal)) {
                if ($request->cityModal == "all") {
                    $city_ids = $this->applicationRecentSeenRepository->cities()->pluck('id')->toArray();

                    $applications = $applications->whereIn('city_id', $city_ids);
                } else
                    $applications = $applications->where('city_id', $request->cityModal);
            }
            if (isset($request->neighborhood)) {
                $applications = $applications->whereIn('neighborhood_id', $request->neighborhood);
            }
            if (isset($request->neighborhoodModal)) {
                $applications = $applications->whereIn('neighborhood_id', $request->neighborhoodModal);
            }
            if (isset($request->attributeTypeSelect)) {
                $applications = $this->selectFilter($request->attributeTypeSelect, $applicationAttributes, $applications);
            }
            if (isset($request->attributeTypeSelect2)) {
                $applications = $this->selectFilter($request->attributeTypeSelect, $applicationAttributes, $applications);
            }
            if (isset($request->attributeTypeNumber)) {
                $applications = $this->numberFilter($request->attributeTypeNumber, $applicationAttributes2, $applications);
            }
            if (isset($request->attributeTypeNumber2)) {
                $applications = $this->numberFilter($request->attributeTypeNumber2, $applicationAttributes2, $applications);
            }
            if (isset($request->attributeTypeBool)) {
                $applications = $this->boolFilter($request->attributeTypeBool, $applicationAttributes, $applications);
            }
            if (isset($request->attributeTypeBool2)) {
                $applications = $this->boolFilter($request->attributeTypeBool2, $applicationAttributes, $applications);
            }
            $content = $this->applicantCard($applications->get());
            return response()->json(['content' => $content]);
        }
        $categories = $this->categoryRepository->categoryDepth1();
        $categories2 = $this->categoryRepository->categoryDepth1();
        $cities = $this->applicationRecentSeenRepository->cities();
        $applications = $applications->get();
        return view('Recentseens::panel.application.index', compact('applications', 'cities', 'categories2',
            'categories', 'category1', 'attributeGroups'));
    }

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
                    $content .= '<p class="request-main-info-data">' . \AttributeItem::where('id', $application->attributes->where('isSignificant', 1)
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

    public function selectFilter($attributeTypeSelect, $applicationAttributes, $applications)
    {
        $selectAttribute = [];
        $array = [];
        foreach ($applicationAttributes as $appAttr){
            if (($appAttr->attribute_item_id1) && isset($appAttr->attribute_item_id2)){
                array_push($array, $appAttr->id);
            }
        }
        $applicationAttributes = DB::table('application_attribute')->whereIn('id', $array)->get();
        foreach ($attributeTypeSelect as $key => $attr1) {
            if (!(($attr1['min'] == null) && ($attr1['max'] == null))) {
                if (($attr1['min'] != null) && ($attr1['max'] != null)) {
                    $applicationAttributes = $applicationAttributes->filter(function ($item) use ($attr1) {
                            return (AttributeItem::find($item->attribute_item_id1)->title >= AttributeItem::find($attr1['min'])->title) ||
                            (AttributeItem::find($item->attribute_item_id1)->title <= AttributeItem::find($attr1['max'])->title) ||
                            (AttributeItem::find($item->attribute_item_id2)->title <= AttributeItem::find($attr1['max'])->title) ||
                            (AttributeItem::find($item->attribute_item_id2)->title >= AttributeItem::find($attr1['min'])->title);
                    });

                } elseif ($attr1['max'] != null) {
                    $applicationAttributes = $applicationAttributes->filter(function ($item) use ($attr1) {
                        return (AttributeItem::find($item->attribute_item_id1)->title <= AttributeItem::find($attr1['max'])->title) ||
                            (AttributeItem::find($item->attribute_item_id2)->title <= AttributeItem::find($attr1['max'])->title);
                    });
                } elseif ($attr1['min'] != null) {
                    $applicationAttributes = $applicationAttributes->filter(function ($item) use ($attr1) {
                            return (AttributeItem::find($item->attribute_item_id1)->title >= AttributeItem::find($attr1['min'])->title) ||
                                (AttributeItem::find($item->attribute_item_id2)->title >= AttributeItem::find($attr1['min'])->title);
                    });
                }
            }
            foreach ($applicationAttributes->pluck('id')->toArray() as $attr_item) {
                array_push($selectAttribute, $attr_item);
            }
            $applications = $applications->whereIn('id', DB::table('application_attribute')
                ->whereIn('id', $selectAttribute)->pluck('application_id'));
        }
        return $applications;
    }

    public function boolFilter($attributeTypeBool, $applicationAttributes, $applications)
    {
        $attr_array = [];
        $flagAttrType1 = 0;
        foreach ($attributeTypeBool as $key => $attrBool) {
            if ($attrBool == ["1"]) {
                $flagAttrType1 = 1;
                $applicationAttributes = $applicationAttributes->where('attribute_id', $key);
                foreach ($applicationAttributes->pluck('id')->toArray() as $attr_item) {
                    array_push($attr_array, $attr_item);
                }
                $applications = $applications->whereIn('id', DB::table('application_attribute')
                    ->whereIn('id', $attr_array)->pluck('application_id'));
            }
        }
        if ($flagAttrType1 == 1)
            $applications = $applications->whereIn('id', DB::table('application_attribute')
                ->whereIn('id', $attr_array)->pluck('application_id'));
        return $applications;
    }

    public function numberFilter($attributeTypeNumber, $applicationAttributes2, $applications)
    {
        $adIds2 = [];
        $flag = 0;
        $adIds = [];

        $applicationAttributes3 = [];
        foreach ($attributeTypeNumber as $key1 => $vals) {
            $arrrr = [];
            if (!(($vals['min'] == null) && ($vals['max'] == null))) {
                if (($vals['min'] != null) && ($vals['max'] != null)) {
                    if (Attribute::where('id', $key1)->first()->hasScale) {
                        $applicationAttributes3 = $applicationAttributes2->filter(function ($item) use ($vals) {
                            return ($item->value1 >= str_replace(',', '', $this->convertToEnglish($vals['min']))) ||
                                ($item->value1 <= str_replace(',', '', $this->convertToEnglish($vals['max']))) ||
                                ($item->value2 <= str_replace(',', '', $this->convertToEnglish($vals['min']))) ||
                                ($item->value2 >= str_replace(',', '', $this->convertToEnglish($vals['max'])));
                        });
                    } else {
                        $applicationAttributes3 = $applicationAttributes2->filter(function ($item) use ($vals) {
                            return ($item->value1 >= str_replace(',', '', $this->convertToEnglish($vals['min']))) ||
                                ($item->value1 <= str_replace(',', '', $this->convertToEnglish($vals['max'])));
                        });
                    }
                } elseif ($vals['max'] != null) {
                    if (Attribute::where('id', $key1)->first()->hasScale) {
                        $applicationAttributes3 = $applicationAttributes2->filter(function ($item) use ($vals) {
                            return ($item->value1 <= str_replace(',', '', $this->convertToEnglish($vals['max']))) ||
                                ($item->value2 >= str_replace(',', '', $this->convertToEnglish($vals['max'])));
                        });
                    } else {
                        $applicationAttributes3 = $applicationAttributes2->filter(function ($item) use ($vals) {
                            return ($item->value1 <= str_replace(',', '', $this->convertToEnglish($vals['max'])));
                        });
                    }
                } elseif (($vals['min'] != null)) {
                    if (Attribute::where('id', $key1)->first()->hasScale) {
                        $applicationAttributes3 = $applicationAttributes2->filter(function ($item) use ($vals) {
                            return ($item->value1 >= str_replace(',', '', $this->convertToEnglish($vals['min']))) ||
                                ($item->value2 <= str_replace(',', '', $this->convertToEnglish($vals['min'])));
                        });
                    } else {
                        $applicationAttributes3 = $applicationAttributes2->filter(function ($item) use ($vals) {
                            return ($item->value1 >= str_replace(',', '', $this->convertToEnglish($vals['min'])));
                        });
                    }
                }
                foreach ($applicationAttributes3 as $adAttr) {
                    array_push($adIds, $adAttr->application_id);
                }
                if ($flag == 0) {
                    $adIds2 = $adIds;
                } else {
                    $adIds2 = array_intersect($adIds, $adIds2);
                }
                $flag += 1;
            }
        }
        $checkVals = 0;
        foreach ($attributeTypeNumber as $key1 => $vals) {
            if (($vals['min'] != null) || ($vals['max'] != null)) {
                $checkVals = 1;
            }
        }
        if ($checkVals == 1)
            $applications = $applications->whereIn('id', $adIds2);
        return $applications;
    }

    public function getAttributeGroups($category_id, $advertiser)
    {
        $category = Category::find($category_id);
        $paths = explode(',', $category->path);
        $nodes = [];
        foreach ($category->groupAttributes()->where('advertiser', $advertiser)->get() as $attrGroup) {
            if ($attrGroup->attributes->count() > 0)
                $nodes[$attrGroup->id] = $attrGroup->id;
        }
        if ($category->path != null) {
            for ($i = 0; $i < count($paths); $i++) {
                if (Category::where('id', $paths[$i])->first()->groupAttributes()->where('advertiser', $advertiser)->count() >= 1) {
                    foreach (Category::where('id', $paths[$i])->first()->groupAttributes()->where('advertiser', $advertiser)->get() as $attrGroup) {
                        if ($attrGroup->attributes->count() > 0)
                            $nodes[$attrGroup->id] = $attrGroup->id;
                    }
                }
            }
        }
        $attrGroups = GroupAttribute::whereIn('id', $nodes)->get();
        return $attrGroups;
    }
}

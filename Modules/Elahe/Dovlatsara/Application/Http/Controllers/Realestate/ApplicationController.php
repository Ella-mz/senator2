<?php

namespace Modules\Application\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\ApplicantMembership\Entities\ApplicantMembership;
use Modules\Application\Entities\Application;
use Modules\Application\Entities\ApplicationNeighborhood;
use Modules\Application\Http\Traits\ApplicantCardTrait;
use Modules\Application\Http\Traits\StoreApplicationTrait;
use Modules\Application\Repositories\ApplicationRepository;
use Modules\Attribute\Entities\Attribute;
use Modules\AttributeItem\Entities\AttributeItem;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Entities\City;
use Modules\City\Repositories\CityRepository;
use Modules\CommonQuestion\Entities\CommonQuestion;
use Modules\EnumType\Repositories\EnumTypeRepository;
use Modules\GroupAttribute\Entities\GroupAttribute;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\Recentseen\Entities\ApplicationRecentseen;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Repositories\UserRepository;
use RealRashid\SweetAlert\Facades\Alert;

class ApplicationController extends Controller
{
    use StoreApplicationTrait, ApplicantCardTrait;

    private $repo;
    private $userRepository;
    private $cityRepository;
    private $categoryRepository;
    private $settingRepository;
    private $enumTypeRepository;

    public function __construct(ApplicationRepository $applicationRepository, UserRepository $userRepository,
                                CategoryRepository $categoryRepository, CityRepository $cityRepository,
                                SettingRepository $settingRepository, EnumTypeRepository $enumTypeRepository)
    {
        $this->repo = $applicationRepository;
        $this->userRepository = $userRepository;
        $this->cityRepository = $cityRepository;
        $this->categoryRepository = $categoryRepository;
        $this->settingRepository = $settingRepository;
        $this->enumTypeRepository = $enumTypeRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $category1 = null;
        $cats = null;
        $attributeGroups = null;
        $category1 = null;
        if (isset($request->category))
            $category1 = $this->repo->findCategoryById($request->category);
        if ($category1) {
            $childCats = $this->getLastNodewithItself($category1);
            $cats = $this->repo->nodeCatsWithIds($childCats)->pluck('id')->toArray();
            $attributeGroups = $this->getAttributeGroups($category1->id, 'applicant');
        }
        if ($cats)
            $applications = $this->repo->applicationsForPanelWithCats($cats);
        else
            $applications = $this->repo->all();
        $application_ids = $applications->pluck('id');
        $applicationAttributes = $this->repo->applicationAttributeWithapplicationIds($application_ids);
        $applicationAttributes2 = $this->repo->applicationAttributeWithapplicationIds($application_ids);
        if ((isset($request->attributeTypeSelect) || isset($request->attributeTypeBool) || isset($request->attributeTypeNumber)
            || isset($request->attributeTypeSelect2) || isset($request->attributeTypeBool2) || isset($request->city) ||
            isset($request->attributeTypeNumber2) || isset($request->cityModal) || isset($request->neighborhoodModal)
            || isset($request->neighborhood) || isset($request->categoryInForm)
            || isset($request->categoryInFormModal))) {
            if (isset($request->city)) {
                if ($request->city != "all")
                    $applications = $applications->where('city_id', $request->city);

            }
            if (isset($request->cityModal)) {
                if ($request->cityModal != "all")
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
        $cities = $this->cityRepository->all();
        $applications = $applications->get();
        return view('Applications::realestate.index', compact('applications', 'categories',
            'categories2', 'attributeGroups', 'category1', 'cities'));
    }

    /**
     * @param $attributeTypeSelect
     * @param $applicationAttributes
     * @param $applications
     * @return mixed
     */
    public function selectFilter($attributeTypeSelect, $applicationAttributes, $applications)
    {
        $selectAttribute = [];
        $array = [];
        foreach ($applicationAttributes as $appAttr) {
            if (($appAttr->attribute_item_id1) && isset($appAttr->attribute_item_id2)) {
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

    /**
     * @param $attributeTypeBool
     * @param $applicationAttributes
     * @param $applications
     * @return mixed
     */
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

    /**
     * @param $attributeTypeNumber
     * @param $applicationAttributes2
     * @param $applications
     * @return mixed
     */
    public function numberFilter($attributeTypeNumber, $applicationAttributes2, $applications)
    {
        $adIds2 = [];
        $flag = 0;
        $applicationAttributes3 = [];
        foreach ($attributeTypeNumber as $key1 => $vals) {
            $arrrr = [];
            $adIds = [];
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

    /**
     * @param $applicationId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($applicationId)
    {
        $application = $this->repo->findApplicationById($applicationId);
        return view('Applications::admin.show', compact('application'));

    }

    /**
     * @param $type
     * @return false|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function selectCategory($type)
    {
        $category_id = collect(request('categoryId'));

        if (count($category_id))
            $cat = Category::where('id', Category::where('id', $category_id)->first()->id)->first();
        $content = '';
        if (!count($category_id)) {
            $cats = Category::where('depth', 1)->get();
            return view('Applications::user.selectCategory',
                compact('cats', 'type'));
        } else {
            $cats = $cat->categories()->get();
            if (count($cats)) {
                $content .= '<li class="li-bg-gray" onclick="prevCats(this.id)" id="' . $cat->id . '"><span>بازگشت به ' . $this->repo->findCategoryById($cat->id)->title . '</span><i class="fa fa-angle-right"></i></li>';
                foreach ($cats as $key => $c) {
                    if ($key % 2 == 0) {
                        $content .= '<li class="li-bg-light-gray" onclick="nextCats(this.id)" id="' . $c->id . '"> <span>' . $c->title . ' </span><i class="fa fa-angle-left"></i></li>';
                    } else {
                        $content .= '<li class="li-bg-gray" onclick="nextCats(this.id)" id="' . $c->id . '"> <span>' . $c->title . ' </span><i class="fa fa-angle-left"></i></li>';

                    }
                }
                return json_encode([
                    'content' => $content,
                ]);
            } else {
                return json_encode([
                    'ad' => $type,
                ]);
            }
        }
    }

    /**
     * @param $type
     * @return false|string
     */
    public
    function prevCats($type)
    {
        $category_id = collect(request('categoryId'));
        $cat = Category::where('id', Category::where('id', $category_id)->first()->id)->first();
        if ($cat->parent_id != 0) {
            $cat2 = $cat->category()->first();
            $cats = $cat2->categories()->get();
        } else {
            $cat2 = $cat;
            $cats = Category::where('depth', 1)->get();
        }
        $content = '';
        if (count($cats)) {
            if ($cat->parent_id != 0)
                $content .= '<li class="li-bg-gray" onclick="prevCats(this.id)" id="' . $cat2->id . '"><span>بازگشت به ' . $this->repo->findCategoryById($cat2->id)->title . '</span><i class="fa fa-angle-right"></i></li>';
            foreach ($cats as $key => $c) {
                if ($key % 2 == 0) {
                    $content .= '<li class="li-bg-light-gray" onclick="nextCats(this.id)" id="' . $c->id . '"> <span>' . $c->title . ' </span><i class="fa fa-angle-left"></i></li>';

                } else {
                    $content .= '<li class="li-bg-gray" onclick="nextCats(this.id)" id="' . $c->id . '"> <span>' . $c->title . ' </span><i class="fa fa-angle-left"></i></li>';

                }
            }
            return json_encode([
                'content' => $content,
            ]);
        } else {
            return json_encode([
                'ad' => $type,
            ]);
        }
    }

    /**
     * @param $category_id
     * @param $advertiser
     * @return mixed
     */
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

    /**
     * @return false|string
     */
    public function recentSeen()
    {
        $id = request('applicationId');
        if ($id) {
            if (!ApplicationRecentseen::where('user_id', \auth()->id())->where('application_id', $id)->first())
                ApplicationRecentseen::create([
                    'user_id' => \auth()->id(),
                    'application_id' => $id
                ]);
            return json_encode('success');
        } else
            return json_encode('fail');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function contact()
    {
        $id = request('applicationId');

        $application = $this->repo->findApplicationById($id);
        $content = '';
        $membershipIds = [];
//            ApplicantMembership::
//        where('role_type', \auth()->user()->roles()->first()->slug)
//            ->pluck('id')->toArray();

//        $mem_user_ids = DB::table('membership_user')
//            ->where('user_id', \auth()->id())
//           ->pluck('id')->toArray();
//        $applicant_membership_user = DB::table('applicant_membership_user')
//            ->whereIn('id', $mem_user_ids)
//            ->orderByDesc('endDate');

        if (ApplicationRecentseen::where('application_id', $application->id)
                ->where('user_id', \auth()->id())->first()->isSeen == 1) {
            $content .= '<div class="request-contact-info"><div class="name"><p>' . $application->user->name .
                ' ' . $application->user->sirName . '</p></div>';
            $content .= '<div class="phoneNum" style="text-align: left;"><p>' .
                $application->phone . '</p>' . '<p>' .
                $application->mobile . '</p></div></div>';
            return response()->json(['content' => $content]);
        }
        if (\auth()->id() == $application->user_id || \auth()->user()->hasRole('admin')) {
            ApplicationRecentseen::where('application_id', $application->id)
                ->where('user_id', \auth()->id())
                ->update([
                    'isSeen' => 1
                ]);
            $content .= '<div class="request-contact-info"><div class="name"><p>' . $application->user->name .
                ' ' . $application->user->sirName . '</p></div>';
            $content .= '<div class="phoneNum" style="text-align: left;"><p>' .
                $application->phone . '</p>' . '<p>' .
                $application->mobile . '</p></div></div>';
        }
        $mem_ship = \auth()->user()->memberships()
            ->wherePivot('startDate', '<=', \Carbon\Carbon::now())
            ->wherePivot('endDate', '>', Carbon::now())
            ->first();
        if (!$mem_ship){
            $content .= '<div>برای نمایش اطلاعات';
            $content .= '<a target="_blank" href="'. route('membership.index.realestate') .'" style="color: #0a58ca">  بسته اشتراک </a>';
            $content .= 'تهیه فرمایید. </div>';
            return response()->json(['content' => $content]);
        }
        $user_membership = DB::table('membership_user')->where('user_id', \auth()->id())
            ->where('membership_id', $mem_ship->id)
            ->where('startDate', '<=', \Carbon\Carbon::now())
            ->where('endDate', '>', Carbon::now())->first();
        if ($mem_ship) {
            $score = $this->enumTypeRepository->findEnumTypeByTitle('submit_scalar_ad_score')->link;
//            $score = $this->settingRepository->getSettingByTitle('see_application_score')->str_value;
            if ($user_membership->remain_score > 0 && ($user_membership->remain_score >= $score)) {
                ApplicationRecentseen::where('application_id', $application->id)
                    ->where('user_id', \auth()->id())->first()
                    ->update([
                        'isSeen' => 1
                    ]);
                $user_membership->update(['remain_score' => $user_membership->remain_score - $score]);

//            $count = $applicant_membership_user->first()->remain_number_of_applications-1;
//
//            $applicant_membership_user->update([
//               'remain_number_of_applications' => $count,
//            ]);
                $content .= '<div class="request-contact-info"><p>' . $application->user->name . ' ' . $application->user->sirName . '</p>';
                $content .= '<p>' . $application->phone . '</p><p></p>' . '<p>' . $application->mobile . '</p></div>';
            }
            else
                $content .= '<div class="request-contact-info"><p>برای مشاهده اطلاعات تماس حق اشتراک خریداری کنید.</p></div>';
        } else
            $content .= '<div class="request-contact-info"><p>برای مشاهده اطلاعات تماس حق اشتراک خریداری کنید.</p></div>';
        return response()->json(['content' => $content]);
    }

    /**
     * @param $agencyId
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function postedSpecificAgency($agencyId, Request $request)
    {
        $adminOfAgency = $this->userRepository->userFindById($agencyId);
        $category1 = null;
        $cats = null;
        $attributeGroups = null;
        if ($category1) {
            $childCats = $this->getLastNodewithItself($category1);
            $cats = $this->repo->nodeCatsWithIds($childCats)->pluck('id')->toArray();
            $attributeGroups = $this->getAttributeGroups($category1->id, 'applicant');
        }
        if ($cats)
            $applications = $this->repo->postedAdsForSpecificAgencyWithCats($cats, $adminOfAgency);
        else
            $applications = $this->repo->postedAdsForSpecificAgency($adminOfAgency);
        $application_ids = $applications->pluck('id');
        $applicationAttributes = $this->repo->applicationAttributeWithapplicationIds($application_ids);
        $applicationAttributes2 = $this->repo->applicationAttributeWithapplicationIds($application_ids);
        if ((isset($request->attributeTypeSelect) || isset($request->attributeTypeBool) || isset($request->attributeTypeNumber)
            || isset($request->attributeTypeSelect2) || isset($request->attributeTypeBool2) || isset($request->city) ||
            isset($request->attributeTypeNumber2) || isset($request->cityModal) || isset($request->neighborhoodModal)
            || isset($request->neighborhood) || isset($request->categoryInForm)
            || isset($request->categoryInFormModal))) {
            if (isset($request->city)) {
                if ($request->city == "all") {
                    $city_ids = $this->repo->cities()->pluck('id')->toArray();

                    $applications = $applications->whereIn('city_id', $city_ids);

                } else
                    $applications = $applications->where('city_id', $request->city);

            }
            if (isset($request->cityModal)) {
                if ($request->cityModal == "all") {
                    $city_ids = $this->repo->cities()->pluck('id')->toArray();

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
        $applications = $applications->get()->load('user', 'city', 'neighborhoods');
        $categories = $this->categoryRepository->categoryDepth1();
        $categories2 = $this->categoryRepository->categoryDepth1();
        $cities = $this->cityRepository->all();

        $cat1 = $this->categoryRepository->categoryFindById($adminOfAgency->category_id);
        return view('Applications::realestate.postedSpecificAgency', compact('applications',
            'category1', 'categories', 'categories2', 'cities', 'attributeGroups', 'cats', 'cat1', 'adminOfAgency'));
    }
}

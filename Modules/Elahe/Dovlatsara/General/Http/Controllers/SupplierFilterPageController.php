<?php

namespace Modules\General\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\General\Http\Traits\AttributeFilterTrait;
use Modules\General\Http\Traits\SupplierAdCard;
use Modules\General\Repositories\GeneralRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class SupplierFilterPageController extends Controller
{
    use UploadFileTrait, GetGroupAttributeTrait, SupplierAdCard, AttributeFilterTrait;

    public $repo;
    private $advertisingRepository;
    private $advertisingApplicationRepository;

    public function __construct(GeneralRepository $generalRepository, AdvertisingRepository $advertisingRepository,
                                AdvertisingApplicationRepository $advertisingApplicationRepository)
    {
        $this->repo = $generalRepository;
        $this->advertisingRepository = $advertisingRepository;
        $this->advertisingApplicationRepository = $advertisingApplicationRepository;
    }

    public function adTypeFilter(Request $request)
    {

        $attributeGroups = null;
        $cities = $this->repo->cities();
        $ads = $this->repo->adsTypeFilter($request)->paginate(20);
        $categories = $this->repo->categoriesDepth1();
        return view('Generals::user.supplierFilterPage', compact('ads', 'attributeGroups', 'categories', 'cities'));

    }



    public function index(Request $request)
    {
        $attributeGroups = null;
        $cats = null;
        $category1 = null;
        if (isset($request->category))
            $category1 = $this->repo->categoryFindId($request->category);

        if ($category1) {
            $childCats = $this->getLastNodewithItself($category1);
            $cats = $this->repo->nodeCatsWithIds($childCats)->pluck('id')->toArray();
            $attributeGroups = $this->getAttributeGroups($category1->id, 'supplier');
        }

        if ($cats)
            $ads = $this->repo->adsWithCat($cats);
        else
            $ads = $this->repo->ads();
        if (session('cities'))
            $ads = $ads->whereIn('city_id', session('cities'));
        if (isset($request->type))
            $ads = $ads->where('type', 'emergency');
        $type = $request->type;
        $tag = $request->search;
        if (isset($tag)) {
            $ads = $ads->where(function ($query) use ($tag) {
                $query->where('title', 'LIKE', '%' . $tag . '%');
            })->orWhere(function ($query) use ($tag) {
                $query->where('uniqueCodeOfAd', 'LIKE', '%' . $tag . '%');
            });
        }
        $cities = $this->repo->cities();
        $ad_ids2 = $ads->pluck('id');
        $adAttributes = $this->repo->adAttributeWithAdIds($ad_ids2);
        $adAttributes2 = $this->repo->adAttributeWithAdIds($ad_ids2);

        if ((isset($request->attributeTypeSelect) || isset($request->attributeTypeBool) || isset($request->attributeTypeNumber)
            || isset($request->attributeTypeSelect2) || isset($request->attributeTypeBool2) || isset($request->city) ||
            isset($request->attributeTypeNumber2) || isset($request->cityModal) || isset($request->neighborhoodModal)
            || isset($request->neighborhood) || isset($request->categoryInForm) || isset($request->attributeAlt2) || isset($request->attributeAlt1)
            || isset($request->categoryInFormModal) || isset($request->adWithImageModal) || isset($request->adWithImage) ||
            isset($request->emergencyTypeModal))) {
            if (isset($request->emergencyType)) {
                $ads = $ads->where('type', 'emergency');
            }
            if (isset($request->emergencyTypeModal)) {

                $ads = $ads->where('type', 'emergency');
            }
//            if (isset($request->categoryInForm)) {
////                return response()->json(['categoryInForm']);
//                $childArray = $this->getLastNodewithItself($this->repo->categoryFindId($request->categoryInForm));
//                $ads = $ads->whereIn('category_id', $childArray);
////                return response()->json(['content' => $ads->get()]);
//
//            }
//            if (isset($request->categoryInFormModal)) {
////                return response()->json(['categoryInFormModal']);
//
//                $childArray = $this->getLastNodewithItself($this->repo->categoryFindId($request->categoryInFormModal));
//                $ads = $ads->whereIn('category_id', $childArray);
//            }
            if (isset($request->type)) {

                $ads = $ads->where('type', $request->type);
            }
            if (isset($request->attributeAlt1)) {
                $ads = $this->altFilter($request->attributeAlt1, $adAttributes, $ads);
            }
            if (isset($request->attributeAlt2)) {
                $ads = $this->altFilter($request->attributeAlt2, $adAttributes, $ads);
            }
            if (isset($request->city)) {

                if ($request->city == "all") {
                    $city_ids = $this->repo->cities()->pluck('id')->toArray();

                    $ads = $ads->whereIn('city_id', $city_ids);

                } else
                    $ads = $ads->where('city_id', $request->city);

            }
            if (isset($request->cityModal)) {
                if ($request->cityModal == "all") {
                    $city_ids = $this->repo->cities()->pluck('id')->toArray();

                    $ads = $ads->whereIn('city_id', $city_ids);
                } else
                    $ads = $ads->where('city_id', $request->cityModal);
            }

            if (isset($request->neighborhood)) {
                $ads = $ads->whereIn('neighborhood_id', $request->neighborhood);
            }

            if (isset($request->neighborhoodModal)) {
                $ads = $ads->whereIn('neighborhood_id', $request->neighborhoodModal);
            }
            if (isset($request->attributeTypeSelect)) {

                $ads = $this->selectFilter($request->attributeTypeSelect, $adAttributes, $ads);
            }
            if (isset($request->attributeTypeBool)) {
                $ads = $this->boolFilter($request->attributeTypeBool, $adAttributes, $ads);
            }
            if (isset($request->attributeTypeNumber)) {
                $ads = $this->numberFilter($request->attributeTypeNumber, $adAttributes2, $ads);
            }
            if (isset($request->attributeTypeSelect2)) {

                $ads = $this->selectFilter($request->attributeTypeSelect2, $adAttributes, $ads);

            }
            if (isset($request->attributeTypeBool2)) {
                $ads = $this->boolFilter($request->attributeTypeBool2, $adAttributes, $ads);
            }
            if (isset($request->attributeTypeNumber2)) {
                $ads = $this->numberFilter($request->attributeTypeNumber2, $adAttributes2, $ads);

            }
            if (isset($request->adWithImage)) {
                $arr = [];
                foreach ($ads->get() as $ad) {
                    if (count($ad->adImages) > 0) {
                        array_push($arr, $ad->id);
                    }
                }
                $ads = $ads->whereIn('id', $arr);

            }
            if (isset($request->adWithImageModal)) {
                $arr = [];
                foreach ($ads->get() as $ad) {
                    if (count($ad->adImages) > 0) {
                        array_push($arr, $ad->id);
                    }
                }
                $ads = $ads->whereIn('id', $arr);

            }

            $content = $this->supplierCard($ads->get());
            return response()->json(['content' => $content]);
        }
        $categories = $this->repo->categoriesDepth1();
        $categories2 = $this->repo->categoriesDepth1();
        $ads = $ads->paginate(102);
        $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('FilterPage');
        $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
//        $page_id = Page::where('title', 'FilterPage')->first()->id;
//        $advertising_order_ids = AdvertisingOrder::where('page_id', $page_id)->pluck('id')->toArray();
//        $advertisement_ids = Advertising::whereIn('advertising_order_id', $advertising_order_ids)->pluck('id')->toArray();
//        $advertisement = AdvertisingApplication::where('active', 1)->where('isPaid', 1)
//            ->whereIn('advertising_id', $advertisement_ids)
//            ->where('startDate', '>=', Verta::now()->startMonth())
//            ->where('endDate', '<=', Verta::now()->endMonth())->get();
        return view('Generals::user.supplierFilterPage', compact('ads', 'categories', 'attributeGroups', 'cities',
            'categories2', 'category1', 'type', 'advertisement'));
    }

    public function boolFilter($attributeTypeBool, $adAttributes, $ads)
    {

        $attr_array = [];
        $flagAttrType1 = 0;
        foreach ($attributeTypeBool as $key => $attrBool) {
            if ($attrBool == ["1"]) {
                $flagAttrType1 = 1;
                $adAttributes = $adAttributes->where('attribute_id', $key);

                foreach ($adAttributes->pluck('id')->toArray() as $attr_item) {
                    array_push($attr_array, $attr_item);
                }

                $ads = $ads->whereIn('id', DB::table('ad_attribute')->whereIn('id', $attr_array)->pluck('ad_id'));
            }
        }
        if ($flagAttrType1 == 1)
            $ads = $ads->whereIn('id', DB::table('ad_attribute')->whereIn('id', $attr_array)->pluck('ad_id'));
        return $ads;
    }

    public function selectFilter($attributeTypeSelect, $adAttributes, $ads)
    {
        $selectAttribute = [];
        foreach ($attributeTypeSelect as $key => $attr1) {
            $adAttributes = $adAttributes->where('attribute_id', $key)->whereIn('attribute_item_id', $attr1);
            foreach ($adAttributes->pluck('id')->toArray() as $attr_item) {
                array_push($selectAttribute, $attr_item);
            }
            $ads = $ads->whereIn('id', DB::table('ad_attribute')->whereIn('id', $selectAttribute)->pluck('ad_id'));
        }
        return $ads;
    }

    public function altFilter($attributeTypeBool, $adAttributes, $ads)
    {
        $attr_array = [];
        $flagAttrType1 = 0;
        foreach ($attributeTypeBool as $key => $attrAlt) {
            if ($attrAlt == ["1"]) {
                $flagAttrType1 = 1;
                $adAttributes = $adAttributes->where('attribute_id', $key)->where('alt_value', 1);

                foreach ($adAttributes->pluck('id')->toArray() as $attr_item) {
                    array_push($attr_array, $attr_item);
                }

                $ads = $ads->whereIn('id', DB::table('ad_attribute')->whereIn('id', $attr_array)->pluck('ad_id'));
            }
        }
        if ($flagAttrType1 == 1)
            $ads = $ads->whereIn('id', DB::table('ad_attribute')->whereIn('id', $attr_array)->pluck('ad_id'));

        return $ads;
    }

    public function numberFilter($attributeTypeNumber, $adAttributes2, $ads)
    {
        $adIds2 = [];
        $flag = 0;
        $adAttributes3 = [];

        foreach ($attributeTypeNumber as $key1 => $vals) {
            $arrrr = [];
            $adIds = [];
            if (!(($vals['min'] == null) && ($vals['max'] == null))) {
                if (($vals['min'] != null) && ($vals['max'] != null)) {
                    $adAttributes3 = $adAttributes2->where('attribute_id', $key1)->where('value', '>=', str_replace(',', '', $this->convertToEnglish($vals['min'])))
                        ->where('value', '<=', str_replace(',', '', $this->convertToEnglish($vals['max'])));
                } elseif ($vals['max'] != null) {
                    $adAttributes3 = $adAttributes2->where('attribute_id', $key1)->where('value', '<=', str_replace(',', '', $this->convertToEnglish($vals['max'])));

                } elseif (($vals['min'] != null)) {
                    $adAttributes3 = $adAttributes2->where('attribute_id', $key1)
                        ->where('value', '>=', str_replace(',', '', $this->convertToEnglish($vals['min'])));
                }
                foreach ($adAttributes3 as $adAttr) {
                    array_push($adIds, $adAttr->ad_id);
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
            $ads = $ads->whereIn('id', $adIds2);
        return $ads;
    }

}

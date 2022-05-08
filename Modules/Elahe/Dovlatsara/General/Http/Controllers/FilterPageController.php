<?php

namespace Modules\General\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\General\Http\Traits\AttributeFilterTrait;
use Modules\General\Http\Traits\FilterAdsTrait;
use Modules\General\Http\Traits\PaginateTrait;
use Modules\General\Http\Traits\SupplierAdCard;
use Modules\General\Repositories\GeneralRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class FilterPageController extends Controller
{
    use UploadFileTrait, GetGroupAttributeTrait, SupplierAdCard, AttributeFilterTrait,
        FilterAdsTrait, PaginateTrait;

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
        return view('Generals::user.filterPage', compact('ads', 'attributeGroups', 'categories', 'cities'));

    }


    public function index(Request $request)
    {
        $pagination = '';
        $paginate = 12;
        $page = $request->pageNumber ?? 1;
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
        $ad_ids2 = $ads->pluck('id');
        $adAttributes = $this->repo->adAttributeWithAdIds($ad_ids2);
        $adAttributes2 = $this->repo->adAttributeWithAdIds($ad_ids2);

        if (isset($request->filter)) {
            $ads = $this->filterAds($ads, $adAttributes, $adAttributes2, $request->attributeTypeSelect, $request->attributeTypeBool, $request->attributeTypeNumber,
                $request->city, $request->neighborhood, $request->categoryInForm, $request->attributeAlt1, $request->adWithImage, $request->emergencyType);
            $ads_count = $ads->get()->count();
            $totalPage = (int)($ads_count / $paginate);

            if ($ads_count>0)
                $pagination = $this->paginateObjects($page, $totalPage);
            else
                $pagination = '<span style="color: rebeccapurple">داده ای با این مشخصات یافت نشد.</span>';
            return response()->json([
                'pagination' => $pagination,
                'content' => $this->supplierCard($ads->skip($page>1?$page * $paginate:0)->take($paginate)->get()),
            ]);
        }

        if (isset($request->modalFilter)) {
            $ads = $this->filterAds($ads, $adAttributes, $adAttributes2, $request->attributeTypeSelect2, $request->attributeTypeBool2, $request->attributeTypeNumber2,
                $request->cityModal, $request->neighborhoodModal, $request->categoryInFormModal, $request->attributeAlt2,
                $request->adWithImageModal, $request->emergencyTypeModal);

            $ads_count = $ads->get()->count();
            $totalPage = (int)($ads_count / $paginate);
            if ($totalPage>0)
                $pagination = $this->paginateObjects($page, $totalPage);
            else
                $pagination = '<span style="color: rebeccapurple">داده ای با این مشخصات یافت نشد.</span>';
            return response()->json([
                'pagination' => $pagination,
                'content' => $this->supplierCard($ads->skip($page * $paginate)->take($paginate)->get()),
            ]);
        }
        $cities = $this->repo->cities();
        $categories = $this->repo->categoriesDepth1();
        $categories2 = $this->repo->categoriesDepth1();
        $ads = $ads->paginate($paginate);
        $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('FilterPage');
        $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
        return view('Generals::user.filterPage', compact('ads', 'categories', 'attributeGroups', 'cities',
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

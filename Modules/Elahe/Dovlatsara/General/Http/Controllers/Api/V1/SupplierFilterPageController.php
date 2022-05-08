<?php

namespace Modules\General\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdCollection;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\Advertising\Transformers\AdvertisingApplicationShowCollection;
use Modules\City\Entities\City;
use Modules\General\Http\Traits\SupplierAdCard;
use Modules\General\Repositories\GeneralRepository;
use Modules\GroupAttribute\Transformers\GroupAttributeCollection;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class SupplierFilterPageController extends Controller
{
    use UploadFileTrait, GetGroupAttributeTrait, SupplierAdCard;

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

    public function getDistanceBetweenPoints($lat1, $long1, $lat2, $long2, $unit)
    {
        $theta = $long1 - $long2;
        $distance = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1))
            * cos(deg2rad($lat2)) * cos(deg2rad($theta));

        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;

        switch ($unit) {
            case 'Mi':
                break;
            case 'Km':
                $distance = $distance * 1.609344;
        }
        return round($distance, 2);
    }

    public function ads()
    {
        $ads = Ad::with('attributes:id,title,unit,min,max,isSignificant,attribute_type')
            ->where('active', 'active')
            ->where('endDate', '>', Carbon::now())
            ->where('advertiser', 'supplier')
            ->where('userStatus', 'active')
            ->where('isPaid', 'paid')
            ->orderByDesc('created_at');
        return $ads;
    }

    public function cities($request)
    {
        $cityArr = [];
        $titles = [];
        foreach (json_decode($request->city, true) as $city) {
            if (City::where('id', $city)->first()) {
                array_push($cityArr, $city);
                array_push($titles, City::find($city)->title);
            }
        }
        return ['cities' => $cityArr, 'titles' => $titles];
    }

    public function sendFilterItems($categoryId)
    {
        try {
            $category = $this->repo->categoryFindId($categoryId);
            $attributeGroups = $this->getAttributeGroupsForFilter($category->id, 'supplier');
            $attributeGroups = $attributeGroups->whereIn('advertiser', ['supplier', 'both'])->pluck('id')->toArray();
            $attributeGroups = $this->repo->attributeGroupsById($attributeGroups);

            return response()->json([
                'data' => new GroupAttributeCollection($attributeGroups),
                'status_code' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'errors' => [],
                'status_code' => 403
            ], 403);
        }
    }

    public function index(Request $request)
    {
//        try {
        $validator = Validator::make($request->all(), [
            'city' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status_code' => 403,
            ], Response::HTTP_FORBIDDEN);
        }
        $cityResponse = $this->cities($request);
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
            $ads = $this->repo->adsWithCat($cats)->whereIn('city_id', $cityResponse['cities']);
        else
            $ads = $this->repo->ads()->whereIn('city_id', $cityResponse['cities']);

//            $ads = $this->ads()->whereIn('city_id', $cityResponse['cities']);
        $ad_ids2 = $ads->pluck('id');
        $adAttributes = $this->repo->adAttributeWithAdIds($ad_ids2);
        $adAttributes2 = $this->repo->adAttributeWithAdIds($ad_ids2);
        $flag = 0;
        if ((isset($request->attributeTypeSelect) || isset($request->attributeTypeBool) || isset($request->attributeTypeNumber)
            || isset($request->neighborhood) || isset($request->category) || isset($request->search) || isset($request->adImage)
            || isset($request->emergency))) {
            if (isset($request->latitude) && isset($request->longitude)) {
                $flag = 1;
                if (isset($request->distance))
                    $req_distance = $this->convertToEnglish($request->distance);
                else
                    $req_distance = 5;
                if (isset($request->unit))
                    $unit = $request->unit;
                else
                    $unit = 'Km';
                $ad_ids_array = [];
                foreach ($ads->get() as $ad) {
                    if (isset($ad->latitude) && isset($ad->longitude)) {
                        $distance = $this->getDistanceBetweenPoints($request->latitude, $request->longitude, $ad->latitude, $ad->longitude, $unit);
                        if ($distance <= $req_distance) {
                            array_push($ad_ids_array, $ad->id);
                        }
                    }
                }
                $ads = Ad::whereIn('id', $ad_ids_array)
                    ->orderBy('priority', 'asc')
                    ->orderByDesc('startDate');
            }
            if (isset($request->emergency)) {

                $ads = $ads->where('type', 'emergency');
            }
            if (isset($request->search)) {
                $tag = $request->search;
                $ads = $ads->where(function ($query) use ($tag) {
                    $query->where('title', 'LIKE', '%' . $tag . '%');
                })->orWhere(function ($query) use ($tag) {
                    $query->where('uniqueCodeOfAd', 'LIKE', '%' . $tag . '%');
                });
            }
            if (isset($request->neighborhood)) {
                $ads = $ads->whereIn('neighborhood_id', json_decode($request->neighborhood, true));

            }
            if (isset($request->adImage)) {
                $arr = [];
                if ($request->adImage == "1") {
                    foreach ($ads->get() as $ad) {
                        if (count($ad->adImages) > 0) {
                            array_push($arr, $ad->id);
                        }
                    }
                    $tags['image'] = 'عکس دار';
                    $ads = $ads->whereIn('id', $arr);
                }
//                foreach ($ads as $ad) {
//                    if (count($ad->adImages) > 0) {
//                        array_push($arr, $ad->id);
//                    }
//                }
//                $ads = $ads->whereIn('id', $arr);

            }
            if (isset($request->attribute)) {
                foreach (json_decode($request->attribute, true) as $attribute) {

                    if ($this->repo->attributeFinById($attribute['id'])->attribute_type == 'int') {
                        $ads = $this->numberFilter($attribute, $adAttributes2, $ads);
                    } elseif ($this->repo->attributeFinById($attribute['id'])->attribute_type == 'bool') {
                        $ads = $this->boolFilter($attribute, $adAttributes, $ads);
                    } elseif ($this->repo->attributeFinById($attribute['id'])->attribute_type == 'select') {
                        $ads = $this->selectFilter($attribute, $adAttributes, $ads);
                    }
                }
//                $ads = $ads->whereIn('id', $adIds);
            }

//                $total_ad_ids = $ads->pluck('id')->toArray();
//
//                $ads = Ad::whereIn('id', $total_ad_ids)->paginate(20);
//
//                $content = $this->supplierCard($ads);
//
//                return response()->json(['content' => $content]);
        }
        $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('FilterPage');
        $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
        if ($flag == 1) {
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => new AdCollection($ads->paginate($ads->count())),
                    'city_titles' => $cityResponse['titles'],
                    'total' => $ads->paginate(10)->total(),
//                'next_page_url' => $contractors->next_page_url(),
                    'path' => $ads->paginate(10)->path(),
                    'perPage' => $ads->paginate(10)->perPage(),
                    'currentPage' => $ads->paginate(10)->currentPage(),
                    'lastPage' => $ads->paginate(10)->lastPage(),
                    'advertisement' => new AdvertisingApplicationShowCollection($advertisement)
                ],
            ], Response::HTTP_OK);
        } else
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => new AdCollection($ads->paginate(10)),
                    'city_titles' => $cityResponse['titles'],
                    'total' => $ads->paginate(10)->total(),
//                'next_page_url' => $contractors->next_page_url(),
                    'path' => $ads->paginate(10)->path(),
                    'perPage' => $ads->paginate(10)->perPage(),
                    'currentPage' => $ads->paginate(10)->currentPage(),
                    'lastPage' => $ads->paginate(10)->lastPage(),
                    'advertisement' => new AdvertisingApplicationShowCollection($advertisement)
                ],
            ], Response::HTTP_OK);
//        } catch (\Exception $e) {
//            return response()->json([
//                'status_code' => 403,
//                'errors' => [],
//            ], Response::HTTP_FORBIDDEN);
//        }
    }

    public function boolFilter($attribute, $adAttributes, $ads)
    {
        $attr_array = [];
        $flagAttrType1 = 0;
        if ($attribute['value'] == "1") {
            $flagAttrType1 = 1;
            $adAttributes = $adAttributes->where('attribute_id', $attribute['id']);

            foreach ($adAttributes->pluck('id')->toArray() as $attr_item) {
                array_push($attr_array, $attr_item);
            }
            $ads = $ads->whereIn('id', $this->repo->adAttributeIdsWithAdIds($attr_array));
        }
        if ($flagAttrType1 == 1)
            $ads = $ads->whereIn('id', $this->repo->adAttributeIdsWithAdIds($attr_array));
//        $tags['attribute' . $attribute['id']] = $this->repo->attributeFinById($attribute['id'])->title;
//        $attr_array = [];
//        $flagAttrType1 = 0;
//        foreach ($attributeTypeBool as $key => $attrBool) {
//            if ($attrBool == ["1"]) {
//                $flagAttrType1 = 1;
//                $adAttributes = $adAttributes->where('attribute_id', $key);
//
//                foreach ($adAttributes->pluck('id')->toArray() as $attr_item) {
//                    array_push($attr_array, $attr_item);
//                }
//
//                $ads = $ads->whereIn('id', DB::table('ad_attribute')->whereIn('id', $attr_array)->pluck('ad_id'));
//            }
//        }
//        if ($flagAttrType1 == 1)
//            $ads = $ads->whereIn('id', DB::table('ad_attribute')->whereIn('id', $attr_array)->pluck('ad_id'));
        return $ads;
    }

    public function selectFilter($attribute, $adAttributes, $ads)
    {
        $attr_array = [];
        if ($attribute['value'] != []) {
            $adAttributes = $adAttributes->where('attribute_id', $attribute['id'])->whereIn('attribute_item_id', $attribute['value']);
            foreach ($adAttributes->pluck('id')->toArray() as $attr_item) {
                array_push($attr_array, $attr_item);
            }
            $ads = $ads->whereIn('id', $this->repo->adAttributeIdsWithAdIds($attr_array));
        }
//        $selectAttribute = [];
//        foreach ($attributeTypeSelect as $key => $attr1) {
//            $adAttributes = $adAttributes->where('attribute_id', $key)->whereIn('attribute_item_id', $attr1);
//            foreach ($adAttributes->pluck('id')->toArray() as $attr_item) {
//                array_push($selectAttribute, $attr_item);
//            }
//            $ads = $ads->whereIn('id', DB::table('ad_attribute')->whereIn('id', $selectAttribute)->pluck('ad_id'));
//        }
        return $ads;
    }

    public function numberFilter($attribute, $adAttributes2, $ads)
    {
        $adIds = [];
        $adIds2 = [];
        $flag = 0;
        if (!(($attribute['min'] == null) && ($attribute['max'] == null))) {
            if (($attribute['min'] != null) && ($attribute['max'] != null)) {
                $adAttributes3 = $adAttributes2->where('attribute_id', $attribute['id'])->where('value', '>=', $attribute['min'])
                    ->where('value', '<=', $attribute['max']);
            } elseif ($attribute['max'] != null) {
                $adAttributes3 = $adAttributes2->where('attribute_id', $attribute['id'])->where('value', '<=', $attribute['max']);

            } elseif (($attribute['min'] != null)) {

                $adAttributes3 = $adAttributes2->where('attribute_id', $attribute['id'])->where('value', '>=', $attribute['min']);
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

        return Ad::whereIn('id', $adIds2);

//        $adIds2 = [];
//        $flag = 0;
//        $adAttributes3 = [];
//        foreach ($attributeTypeNumber as $key1 => $vals) {
//            $arrrr = [];
//            $adIds = [];
//            if (!(($vals['min'] == null) && ($vals['max'] == null))) {
//                if (($vals['min'] != null) && ($vals['max'] != null)) {
//                    $adAttributes3 = $adAttributes2->where('attribute_id', $key1)->where('value', '>=', str_replace(',', '', $this->convertToEnglish($vals['min'])))
//                        ->where('value', '<=', str_replace(',', '', $this->convertToEnglish($vals['max'])));
//                } elseif ($vals['max'] != null) {
//                    $adAttributes3 = $adAttributes2->where('attribute_id', $key1)->where('value', '<=', str_replace(',', '', $this->convertToEnglish($vals['max'])));
//
//                } elseif (($vals['min'] != null)) {
//
//                    $adAttributes3 = $adAttributes2->where('attribute_id', $key1)->where('value', '>=', str_replace(',', '', $this->convertToEnglish($vals['min'])));
//                }
//                foreach ($adAttributes3 as $adAttr) {
//                    array_push($adIds, $adAttr->ad_id);
//                }
//                if ($flag == 0) {
//                    $adIds2 = $adIds;
//                } else {
//                    $adIds2 = array_intersect($adIds, $adIds2);
//                }
//                $flag += 1;
//            }
//        }
//        $checkVals = 0;
//        foreach ($attributeTypeNumber as $key1 => $vals) {
//            if (($vals['min'] != null) || ($vals['max'] != null)) {
//                $checkVals = 1;
//            }
//        }
//        if ($checkVals == 1)
//            $ads = $ads->whereIn('id', $adIds2);
//        return $ads;
    }

}

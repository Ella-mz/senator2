<?php

namespace Modules\General\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Ad\Entities\Ad;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\Article\Repositories\ArticleGroupRepository;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Entities\City;
use Modules\EnumType\Repositories\EnumTypeRepository;
use Modules\General\Http\Traits\FilterAdsTrait;
use Modules\General\Http\Traits\PaginateTrait;
use Modules\General\Http\Traits\SupplierAdCard;
use Modules\General\Repositories\GeneralRepository;
use Modules\Setting\Repository\SettingRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class HomePageController extends Controller
{
    use UploadFileTrait, GetGroupAttributeTrait, SupplierAdCard,
        FilterAdsTrait, PaginateTrait;

    private $advertisingRepository;
    private $advertisingApplicationRepository;
    private $categoryRepository;
    private $enumTypeRepository;
    private $articleRepository;
    private $settingRepository;
    private $articleGroupRepository;
    private $repo;

    public function __construct(CategoryRepository $categoryRepository, AdvertisingRepository $advertisingRepository,
                                AdvertisingApplicationRepository $advertisingApplicationRepository, EnumTypeRepository $enumTypeRepository,
                                ArticleRepository $articleRepository, SettingRepository $settingRepository,
                                ArticleGroupRepository $articleGroupRepository, GeneralRepository $generalRepository)
    {
        $this->repo = $generalRepository;
        $this->categoryRepository = $categoryRepository;
        $this->advertisingRepository = $advertisingRepository;
        $this->advertisingApplicationRepository = $advertisingApplicationRepository;
        $this->enumTypeRepository = $enumTypeRepository;
        $this->articleRepository = $articleRepository;
        $this->settingRepository = $settingRepository;
        $this->articleGroupRepository = $articleGroupRepository;
    }

    public function homePage2(Request $request)
    {
//        $ads = Ad::with('attributes')
//            ->where('active', 'active')
//            ->where('endDate', '>', Carbon::now())
//            ->where('advertiser', 'supplier')
//            ->where('userStatus', 'active')
//            ->where('isPaid', 'paid');
//        if (session('cities'))
//            $ads = $ads->whereIn('city_id', session('cities'));

//        $four_ads = $ads->orderByDesc('created_at')->take(10)->get();
//        $mostWanted_ads = $ads->orderByDesc('viewCount')->take(28)->get();
//        $ads = $ads->orderByDesc('created_at')->where('type', 'emergency')->get();
//        $user_ids = DB::table('role_user')->where('role_id',
//            Role::where('slug', 'real-state-administrator')->first()->id)
//            ->pluck('user_id')->toArray();
//        $shops = User::where('shop_active', 'active')->whereIn('id', $user_ids)
//            ->orderByDesc('created_at')->take(6)->get();
//        $user_ids = DB::table('role_user')->where('role_id', Role::where('slug', 'contractor')->first()->id)->pluck('user_id')->toArray();
//        $contractors = User::where('shop_active', 'active')->whereIn('id', $user_ids)->orderByDesc('created_at')->take(4)->get();
//        $categories = $this->categoryRepository->all();
//        $shop_default_photo = $this->settingRepository->getSettingByTitle('shop_default_photo')->str_value;
//        $shop_default_logo = $this->settingRepository->getSettingByTitle('shop_default_logo')->str_value;
//        $ad_default_photo = $this->settingRepository->getSettingByTitle('ad_default_photo')->str_value;
//        $user_default_photo = $this->settingRepository->getSettingByTitle('user_default_photo')->str_value;

        $pagination = '';
        $paginate = 4;
        $page = $request->pageNumber ?? 1;
        $content = '';
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
            $ads_of_filter = $this->repo->adsWithCat($cats);
        else
            $ads_of_filter = $this->repo->ads();
        if (session('cities'))
            $ads_of_filter = $ads_of_filter->whereIn('city_id', session('cities'));
        if (isset($request->type))
            $ads_of_filter = $ads_of_filter->where('type', 'emergency');
        $type = $request->type;
        $ad_ids2 = $ads_of_filter->pluck('id');
        $adAttributes = $this->repo->adAttributeWithAdIds($ad_ids2);
        $adAttributes2 = $this->repo->adAttributeWithAdIds($ad_ids2);

        if (isset($request->filter)) {
            $ads_of_filter = $this->filterAds($ads_of_filter, $adAttributes, $adAttributes2, $request->attributeTypeSelect, $request->attributeTypeBool, $request->attributeTypeNumber,
                $request->city, $request->neighborhood, $request->categoryInForm, $request->attributeAlt1, $request->adWithImage, $request->emergencyType);
            $ads_count = $ads_of_filter->get()->count();
            $totalPage = (int)($ads_count / $paginate);

            if ($ads_count>0)
                $pagination = $this->paginateObjects($page, $totalPage);
            else
                $pagination = '<span style="color: #ddb24f">داده ای با این مشخصات یافت نشد.</span>';
            return response()->json([
                'pagination' => $pagination,
                'content' => $this->supplierCard($ads_of_filter->skip($page>1?$page * $paginate:0)->take($paginate)->get()),
            ]);
        }

        if (isset($request->modalFilter)) {
            $ads_of_filter = $this->filterAds($ads_of_filter, $adAttributes, $adAttributes2, $request->attributeTypeSelect2, $request->attributeTypeBool2, $request->attributeTypeNumber2,
                $request->cityModal, $request->neighborhoodModal, $request->categoryInFormModal, $request->attributeAlt2,
                $request->adWithImageModal, $request->emergencyTypeModal);

            $ads_count = $ads_of_filter->get()->count();
            $totalPage = (int)($ads_count / $paginate);
            if ($totalPage>0)
                $pagination = $this->paginateObjects($page, $totalPage);
            else
                $pagination = '<span style="color: #ddb24f">داده ای با این مشخصات یافت نشد.</span>';
            return response()->json([
                'pagination' => $pagination,
                'content' => $this->supplierCard($ads_of_filter->skip($page * $paginate)->take($paginate)->get()),
            ]);
        }
        $header_title = $this->settingRepository->getSettingByTitle('header_title_first_page')->str_value;
        $header_image = $this->settingRepository->getSettingByTitle('header_image')->str_value;
        $header_image_responsive = $this->settingRepository->getSettingByTitle( 'header_image_responsive')->str_value;
//        $contractor_men_default_photo = $this->settingRepository->getSettingByTitle('contractor_men_default_photo')->str_value;
//        $contractor_women_default_photo = $this->settingRepository->getSettingByTitle('contractor_women_default_photo')->str_value;
        $header_title_color = $this->settingRepository->getSettingByTitle('header_title_color')->str_value;
        $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('homePage');
        $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
        $appOfWebsite = $this->enumTypeRepository->findEnumTypeByEnumTitle('appOfWebsite');
        $header_icons = $this->enumTypeRepository->findEnumTypesByEnumTitle('header_icons');
//        $articles = $this->articleRepository->mostWantedArticles();
//        $articleGroups = $this->articleGroupRepository->all();
        $cities = $this->repo->cities();
        $categories = $this->categoryRepository->all2();
        $categories2 = $this->repo->categoriesDepth1();
        $ads_of_filter = $ads_of_filter->paginate($paginate);
        $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('homePage');
        $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
        return view('Generals::user.homePageNew', compact('ads_of_filter','categories',
            'attributeGroups', 'cities',  'categories2', 'category1', 'type', 'advertisement',
            'categories', 'header_title', 'header_image', 'header_image_responsive',
            'advertisement', 'content', 'appOfWebsite', 'header_title_color', 'header_icons'));
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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchAdsSupplier(Request $request)
    {
        $activeCategoryIds = $this->categoryRepository->activeCategoryIds();
        $cats = null;
        $attributeGroups = null;
        $cities = City::all();
        $tag = $request->search;
        if (isset($request->cat)) {
            $childArray = $this->getLastNodewithItself($this->categoryRepository->categoryFindById($request->cat));
            $cats = Category::whereIn('id', $childArray)->where('node', 1)->pluck('id')->toArray();
            $ads = Ad::where(function ($query) use ($tag, $cats) {
                $query->whereIn('category_id', $cats)->where('advertiser', 'supplier')->where('endDate', '>', Carbon::now())
                    ->where('title', 'LIKE', '%' . $tag . '%')->where('active', 'active')->where('userStatus', 'active')
                    ->where('isPaid', 'paid');
            })->orWhere(function ($query) use ($tag, $cats) {
                $query->whereIn('category_id', $cats)->where('advertiser', 'supplier')->where('endDate', '>', Carbon::now())
                    ->where('uniqueCodeOfAd', 'LIKE', '%' . $tag . '%')->where('active', 'active')->where('userStatus', 'active')
                    ->where('isPaid', 'paid');
            })->orderByDesc('created_at')->paginate(20);
            $attributeGroups = $this->getAttributeGroups($request->cat, 'supplier');
            $categories = $this->categoryRepository->categoryDepth1();
        } else {
            $ads = Ad::where(function ($query) use ($tag, $cats, $activeCategoryIds) {
                $query->where('advertiser', 'supplier')->where('endDate', '>', Carbon::now())
                    ->where('title', 'LIKE', '%' . $tag . '%')
                    ->where('active', 'active')
                    ->where('userStatus', 'active')
                    ->whereIn('category_id', $activeCategoryIds)
                    ->where('isPaid', 'paid');
            })->orWhere(function ($query) use ($tag, $cats, $activeCategoryIds) {
                $query->where('advertiser', 'supplier')->where('endDate', '>', Carbon::now())
                    ->where('uniqueCodeOfAd', 'LIKE', '%' . $tag . '%')
                    ->where('active', 'active')
                    ->where('userStatus', 'active')
                    ->whereIn('category_id', $activeCategoryIds)
                    ->where('isPaid', 'paid');
            })->orderByDesc('created_at')->paginate(20);
            $categories = $this->categoryRepository->categoryDepth1();
            $categories2 = $this->categoryRepository->categoryDepth1();

        }
        return view('Generals::user.supplierFilterPage', compact('ads',
            'attributeGroups', 'categories', 'cities', 'categories2'));
    }
}

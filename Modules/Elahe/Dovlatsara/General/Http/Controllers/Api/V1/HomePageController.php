<?php

namespace Modules\General\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Repositories\AdRepository;
use Modules\Ad\Transformers\AdCollection;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\Advertising\Transformers\AdvertisingApplicationShowCollection;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Article\Transformers\ArticleCollection;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Transformers\CategoryCollection;
use Modules\City\Entities\City;
use Modules\City\Repositories\CityRepository;
use Modules\EnumType\Repositories\EnumTypeRepository;
use Modules\EnumType\Transformers\HeaderIconCollection;
use Modules\RoleAndPermissionNew\Repositories\RoleRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class HomePageController extends Controller
{
    use UploadFileTrait, GetGroupAttributeTrait;

    private $adRepository;
    private $cityRepository;
    private $roleRepository;
    private $categoryRepository;
    private $enumTypeRepository;
    private $articleRepository;
    private $advertisingRepository;
    private $advertisingApplicationRepository;

    public function __construct(AdRepository $adRepository, CityRepository $cityRepository,
                                RoleRepository $roleRepository, CategoryRepository $categoryRepository,
                                EnumTypeRepository $enumTypeRepository, ArticleRepository $articleRepository,
                                AdvertisingRepository $advertisingRepository,
                                AdvertisingApplicationRepository $advertisingApplicationRepository)
    {
        $this->adRepository = $adRepository;
        $this->cityRepository = $cityRepository;
        $this->roleRepository = $roleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->enumTypeRepository = $enumTypeRepository;
        $this->articleRepository = $articleRepository;
        $this->advertisingRepository = $advertisingRepository;
        $this->advertisingApplicationRepository = $advertisingApplicationRepository;
    }

//    public function ads()
//    {
//        $ads = Ad::with('attributes')
//            ->where('active', 'active')
//            ->where('endDate', '>', Carbon::now())
//            ->where('advertiser', 'supplier')
//            ->where('userStatus', 'active')
//            ->where('isPaid', 'paid')
//            ->orderByDesc('created_at');
//        return $ads;
//    }

    public function cities($request)
    {
        $cityArr = [];
        $titles = [];
        foreach (json_decode($request['city'], true) as $city) {
            if (City::where('id', $city)->first()) {
                array_push($cityArr, $city);
                array_push($titles, City::find($city)->title);
            }
        }
        return ['cities' => $cityArr, 'titles' => $titles];
    }

//    public function totalAds(Request $request)
//    {
//        try {
//            $validator = Validator::make($request->all(), [
//                'city' => 'required',
//            ]);
//            if ($validator->fails()) {
//                return response()->json([
//                    'data' => [],
//                    'errors' => $validator->errors()->all(),
//                    'status_code' => 403,
//                ], Response::HTTP_FORBIDDEN);
//            }
//            $cityResponse = $this->cities($request->all());
//            $total_ads = $this->ads()->whereIn('city_id', $cityResponse['cities'])->paginate(10);
//            return response()->json([
//                'status_code' => 200,
//                'data' => [
//                    'data' => new AdCollection($total_ads),
//                    'city_titles' => $cityResponse['titles'],
//                    'total' => $total_ads->total(),
////                'next_page_url' => $contractors->next_page_url(),
//                    'path' => $total_ads->path(),
//                    'perPage' => $total_ads->perPage(),
//                    'currentPage' => $total_ads->currentPage(),
//                    'lastPage' => $total_ads->lastPage(),
//                ],
//            ], Response::HTTP_OK);
//        } catch (\Exception $e) {
//            return response()->json([
//                'status_code' => 403,
//                'errors' => [],
//            ], Response::HTTP_FORBIDDEN);
//        }
//    }
//
//    public function specialAds(Request $request)
//    {
////        try {
//        $validator = Validator::make($request->all(), [
//            'city' => 'required',
//        ]);
//        if ($validator->fails()) {
//            return response()->json([
//                'data' => $request->header(),
//                'errors' => $validator->errors()->all(),
//                'status_code' => 403,
//            ], Response::HTTP_FORBIDDEN);
//        }
//        $cityResponse = $this->cities($request->all());
//        $special_ads = $this->ads()->where('type', 'special')
//            ->whereIn('city_id', $cityResponse['cities'])->take(10)->get();
//        return response()->json([
//            'status_code' => 200,
//            'data' => [
//                'data' => new AdCollection($special_ads),
//                'city_titles' => $cityResponse['titles']
//            ],
//        ], Response::HTTP_OK);
////        } catch (\Exception $e) {
////            return response()->json([
////                'status_code' => 403,
////                'errors' => [],
////            ], Response::HTTP_FORBIDDEN);
////        }
//    }
//
//    public function contractors(Request $request)
//    {
//        try {
//            $validator = Validator::make($request->all(), [
//                'city' => 'required',
//            ]);
//            if ($validator->fails()) {
//                return response()->json([
//                    'data' => [],
//                    'errors' => $validator->errors()->all(),
//                    'status_code' => 403,
//                ], Response::HTTP_FORBIDDEN);
//            }
//            $background_default_photo = Setting::where('title', 'contractors_default_photo_in_app')->first()->str_value;
//            $cityResponse = $this->cities($request->all());
//            $activityRange_user_ids = ActivityRange::whereIn('city_id', $cityResponse['cities'])
//                ->pluck('user_id')->toArray();
//
//            $user_ids = DB::table('role_user')
//                ->where('role_id', Role::where('slug', 'contractor')->first()->id)
//                ->pluck('user_id')->toArray();
//            $contractors = User::where('shop_active', 'active')->whereIn('id', $user_ids);
//            $contractors = $contractors->whereIn('id', $activityRange_user_ids)
//                ->orderByDesc('created_at')->take(10)->get();
//            return response()->json([
//                'status_code' => 200,
//                'data' => [
//                    'data' => new ContractorCollection($contractors),
//                    'backgroundPhoto' => isset($background_default_photo) ? url($background_default_photo) : '',
//                    'city_titles' => $cityResponse['titles']
//                ],
//            ], Response::HTTP_OK);
//        } catch (\Exception $e) {
//            return response()->json([
//                'status_code' => 403,
//                'errors' => [],
//            ], Response::HTTP_FORBIDDEN);
//        }
//    }
//
//    public function shops(Request $request)
//    {
//        try {
//            $validator = Validator::make($request->all(), [
//                'city' => 'required',
//            ]);
//            if ($validator->fails()) {
//                return response()->json([
//                    'data' => [],
//                    'errors' => $validator->errors()->all(),
//                    'status_code' => 403,
//                ], Response::HTTP_FORBIDDEN);
//            }
//            $background_default_photo = Setting::where('title', 'shop_default_photo_in_app')->first()->str_value;
//
//            $cityResponse = $this->cities($request->all());
//            $activityRange_user_ids = ActivityRange::whereIn('city_id', $cityResponse['cities'])
//                ->pluck('user_id')->toArray();
//            $user_ids = DB::table('role_user')
//                ->where('role_id', Role::where('slug', 'real-state-administrator')->first()->id)
//                ->pluck('user_id')->toArray();
//            $shops = User::where('shop_active', 'active')->whereIn('id', $user_ids);
//            $shops = $shops->whereIn('id', $activityRange_user_ids)
//                ->orderByDesc('created_at')->take(10)->get();
//            return response()->json([
//                'status_code' => 200,
//                'data' => [
//                    'data' => new ShopCollection($shops),
//                    'backgroundPhoto' => isset($background_default_photo) ? url($background_default_photo) : '',
//                    'city_titles' => $cityResponse['titles']
//                ],
//
//            ], Response::HTTP_OK);
//        } catch (\Exception $e) {
//            return response()->json([
//                'status_code' => 403,
//                'errors' => [],
//            ], Response::HTTP_FORBIDDEN);
//        }
//    }

    public function homePage(Request $request)
    {
        try {
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
            $ads = $this->adRepository->adsOfHomePage();
            $general_ads = $ads->take(4)->get();
            $categories_for_show = $this->categoryRepository->categoryDepth1()->where('selected', 1);
            $header_icons = $this->enumTypeRepository->findEnumTypesByEnumTitle('header_icons');
            $articles = $this->articleRepository->allWithoutArticleGroup()->take(10);
            $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('homePage');
            $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);

            return response()->json([
                'status_code' => 200,
                'data' => [
                    'ads' => new AdCollection($general_ads),
                    'categories_for_display' => new CategoryCollection($categories_for_show),
                    'links' => new HeaderIconCollection($header_icons),
                    'articles' => new ArticleCollection($articles),
                    'advertisement' => new AdvertisingApplicationShowCollection($advertisement)

                ],
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 403,
                'errors' => [],
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function getAllLastNode()
    {
        $categories = Category::all();
        $nodes = [];
        foreach ($categories as $key => $category) {
            if (!Category::where('parent_id', $category->id)->first())
                $nodes[$key] = $category->id;
        }
        return $nodes;
    }

    public function getLastNodewithItself($category)
    {
        $nodes = $this->getAllLastNode();
        $nodes = Category::whereIn('id', $nodes)->get();
        $childArray = [];
        foreach ($nodes as $key => $node) {
//            $parents = explode(',', $node->path);
//
//            if (in_array($category->id, $parents))
//                $childArray[$key] = $node->id;
            if ($node->path != null) {
                $parents = explode(',', $node->path);
//                $parents = array_merge($parents, [$category->id]);
                if (in_array($category->id, $parents))
                    $childArray[$key] = $node->id;
            } else {
                if (($category->id == $node->id))
                    $childArray[$key] = $node->id;
            }
        }
        array_push($childArray, $category->id);

        return $childArray;
    }

    public function searchAdsSupplier(Request $request)
    {
        if (isset($request->cat)) {
            $cities = City::all();
            $tag = $request->search;

            $childArray = $this->getLastNodewithItself(Category::where('id', $request->cat)->first());
            $cats = Category::whereIn('id', $childArray)->where('node', 1)->pluck('id');
            $ads = Ad::where(function ($query) use ($tag, $cats) {
                $query->whereIn('category_id', $cats)->where('advertiser', 'supplier')->where('endDate', '>', Carbon::now())
                    ->where('title', 'LIKE', '%' . $tag . '%')->where('active', 'active')->where('userStatus', 'active')
                    ->where('isPaid', 'paid');
            })->orWhere(function ($query) use ($tag, $cats) {
                $query->whereIn('category_id', $cats)->where('advertiser', 'supplier')->where('endDate', '>', Carbon::now())
                    ->where('uniqueCodeOfAd', 'LIKE', '%' . $tag . '%')->where('active', 'active')->where('userStatus', 'active')
                    ->where('isPaid', 'paid');
            })->orderByDesc('created_at')->paginate(20);
            $check = 0;
            $category = Category::where('id', $request->cat)->first();
            $attributeGroups = $this->getAttributeGroups($request->cat, 'supplier');
            $categories = Category::where('depth', 1)->get();

            return view('Generals::user.supplierFilterPage', compact('ads', 'category', 'attributeGroups', 'categories', 'cities'));

//            return view('generalPage.firstFilterPage', compact('ads', 'category1', 'attributes', 'check', 'cities'));
        } else
            return back()->with('mm', 'دسته بندی انتخاب نشده است.')->withInput();
    }
}

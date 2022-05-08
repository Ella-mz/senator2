<?php

namespace Modules\User\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Repositories\AdRepository;
use Modules\Ad\Transformers\AdCollection;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\Advertising\Transformers\AdvertisingApplicationShowCollection;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Article\Transformers\ArticleCollection;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Transformers\CategoryCollection;
use Modules\Category\Transformers\CategoryDisplayInShops;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;
use Modules\User\Transformers\AgentCollection;
use Modules\User\Transformers\Shop;
use Modules\User\Transformers\ShopCollection;
use Illuminate\Http\Response;

class ShopController extends Controller
{
    private $userRepository;
    private $adRepository;
    private $categoryRepository;
    private $articleRepository;
    private $advertisingRepository;
    private $advertisingApplicationRepository;

    public function __construct(AdRepository $adRepository, UserRepository $userRepository,
                                CategoryRepository $categoryRepository, ArticleRepository $articleRepository,
                                AdvertisingRepository $advertisingRepository,
                                AdvertisingApplicationRepository $advertisingApplicationRepository)
    {
        $this->userRepository = $userRepository;
        $this->adRepository = $adRepository;
        $this->categoryRepository = $categoryRepository;
        $this->articleRepository = $articleRepository;
        $this->advertisingRepository = $advertisingRepository;
        $this->advertisingApplicationRepository = $advertisingApplicationRepository;
    }

    public function index(Request $request)
    {
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
        $background_default_photo = Setting::where('title', 'shop_default_photo_in_app')->first()->str_value;
        $user_ids = DB::table('role_user')->where('role_id', Role::where('slug', 'real-state-administrator')->first()->id)
            ->pluck('user_id')->toArray();
        $shops = User::where('shop_active', 'active')->whereIn('id', $user_ids);
//        $shops = $shops->whereIn('id', $activityRange_user_ids);

        $tags = [];
        $shop_ids1 = [];
        $shop_ids2 = [];
        $shop_ids1 = $shops->whereIn('shop_city_id', json_decode($request->city, true))->pluck('id')->toArray();
        $activityRange_user_ids = ActivityRange::whereIn('city_id', json_decode($request->city, true))->pluck('user_id')->toArray();
        $shop_ids2 = $shops->whereIn('id', $activityRange_user_ids)->pluck('id')->toArray();
        $shop_ids1 = array_unique(array_merge($shop_ids1, $shop_ids2));
        if (count($shop_ids1) > 0)
            $shops = User::whereIn('id', $shop_ids1);
        else
            $shops = [];

//        $activityRange_user_ids = ActivityRange::where('city_id', json_decode($request->city, true))->pluck('user_id')->toArray();
//        foreach (json_decode($request->city, true) as $city) {
//            array_push($tags, City::findOrFail($city)->title);
//        }

        if (isset($request->neighborhood) || isset($request->search) || isset($request->category)) {
            if (count($shop_ids1) > 0)
                $shops = $shops->get();
            if (isset($request->search)) {
                $tag = $request->search;
                $shops = $shops->filter(function ($item) use ($tag) {
                    return strstr($item->shop_title, $tag);
                });
            }
            if (isset($request->category) && count(json_decode($request->category, true))) {
                $catArray = [];
                foreach (json_decode($request->category, true) as $cat) {
                    array_push($catArray, $cat);
                    array_push($tags, Category::find($cat)->title);
                }
                $shops = $shops->whereIn('category_id', $catArray);
            }
            if (isset($request->neighborhood) && count(json_decode($request->neighborhood, true))) {
                $neighborhoodArr = [];
                foreach (json_decode($request->neighborhood, true) as $neighborhood) {
                    array_push($neighborhoodArr, $neighborhood);
                    array_push($tags, Neighborhood::find($neighborhood)->title);
                }
                $activityRange_user_ids = ActivityRange::whereIn('neighborhood_id', $neighborhoodArr)->pluck('user_id')->toArray();
                $shops = $shops->whereIn('id', $activityRange_user_ids);
            }
            if (count($shop_ids1) > 0)
                $shop_ids = $shops->pluck('id')->toArray();
            else
                $shop_ids = [];
            $shops = User::whereIn('id', $shop_ids)->paginate(20);
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => new ShopCollection($shops),
                    'tags' => $tags,
                    'backgroundPhoto' => isset($background_default_photo) ? url($background_default_photo) : '',
                    'total' => $shops->total(),
                    'path' => $shops->path(),
                    'perPage' => $shops->perPage(),
                    'currentPage' => $shops->currentPage(),
                    'nextPageUrl' => $shops->nextPageUrl(),
                    'lastPage' => $shops->lastPage(),
                ],
            ], Response::HTTP_OK);
        }
        $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('RealestatePage');
        $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
        $shops = $shops->paginate(20);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => new ShopCollection($shops),
                'tags' => $tags,
                'backgroundPhoto' => isset($background_default_photo) ? url($background_default_photo) : '',
                'total' => $shops->total(),
                'path' => $shops->path(),
                'perPage' => $shops->perPage(),
                'currentPage' => $shops->currentPage(),
                'nextPageUrl' => $shops->nextPageUrl(),
                'lastPage' => $shops->lastPage(),
                'advertisement' => new AdvertisingApplicationShowCollection($advertisement)
            ],

        ], Response::HTTP_OK);
    }

    public function show($slug)
    {
        try {
//            $background_default_photo = Setting::where('title', 'shop_default_photo_in_app')->first()->str_value;

            $user = User::where('slug', $slug)->first();

            if (!$user)
                return response()->json([
                    'status_code' => 404,
                    'errors' => ['slug is invalid'],
                ], Response::HTTP_NOT_FOUND);
            if (!$user->hasRole('real-state-administrator'))
                return response()->json([
                    'status_code' => 403,
                    'errors' => ['this user is not a agency administrator'],
                ], Response::HTTP_FORBIDDEN);


            $real_estate_agents = User::where('real_estate_admin_id', $user->id)->get();
            $user_ids = $real_estate_agents->pluck('id')->toArray();
            $category = $this->categoryRepository->categoryFindById($user->category_id);
            array_push($user_ids, $user->id);
            $nodes = $this->categoryRepository->nodeIds();
            $ads1 = $this->adRepository->adsOfAgency($category, $nodes, $user_ids, $user)->take(4)->get();
            $articles = $this->articleRepository->articlesOfAgency($user->id);
            $agents = $this->userRepository->agents($user->id);
            $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('AgencyPageDetail');
            $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'shop' => new Shop($user),
                    'ads' => new AdCollection($ads1),
                    'articles' => new ArticleCollection($articles),
                    'agents' => new AgentCollection($agents),
                    'advertisement' => new AdvertisingApplicationShowCollection($advertisement)
                ],
//                'backgroundPhoto' => isset($background_default_photo) ? url($background_default_photo) : '',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 403,
                'errors' => [],
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function adsOfShop(Request $request, $slug)
    {
        try {

        $user = User::where('slug', $slug)->first();

        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['slug is invalid'],
            ], Response::HTTP_NOT_FOUND);
        if (!$user->hasRole('real-state-administrator'))
            return response()->json([
                'status_code' => 403,
                'errors' => ['this user is not a real state administrator'],
            ], Response::HTTP_FORBIDDEN);


        $real_estate_agents = User::where('real_estate_admin_id', $user->id)->get();
        $user_ids = $real_estate_agents->pluck('id')->toArray();
        array_push($user_ids, $user->id);
        $category = $this->categoryRepository->categoryFindById($user->category_id);
        $nodes = $this->categoryRepository->nodeIds();
        $categories = [];
        $subCats = [];
        if (isset($user->category_id)) {
            $total_Ads = $this->categoryRepository->categoryFindById($user->category_id)->allAdsOfParentCategory($user->id);
            $cat = Category::find($user->category_id);
            if ($cat->subCategories->count() > 0) {
                foreach ($cat->subCategories as $key => $subCat) {
                    $categories[$key]['id'] = $subCat->id;
                    $categories[$key]['title'] = $subCat->title;
                    $categories[$key]['image'] = $subCat->image;
                    if ($subCat->subCategories->count() > 0) {
                        $subCats = [];
                        foreach ($subCat->subCategories as $key2 => $subCat2) {
                            $ads = $this->adRepository->adsOfAgency($subCat2, null, $user_ids, $user);
                            try {
                                $percentNumber = $ads->count() / $total_Ads->count() * 100;
                            } catch (\Exception $e) {
                                $percentNumber = 0;
                            }
                            $subCats[$key2] = (new CategoryDisplayInShops($subCat2))->foo($ads->count(), $percentNumber);
                        }
                        $categories[$key]['subCategories'] = $subCats;
                    } else {
                        $subCats = [];
                        $ads = $this->adRepository->adsOfAgency($subCat, null, $user_ids, $user);
                        try {
                            $percentNumber = $ads->count() / $total_Ads->count() * 100;
                        } catch (\Exception $e) {
                            $percentNumber = 0;
                        }
                        $subCats[] = (new CategoryDisplayInShops($subCat))->foo($ads->count(), $percentNumber);

                        $categories[$key]['subCategories'] = $subCats;

                    }
                }
            } else {
                $subCats = [];
                $ads = $this->adRepository->adsOfAgency($cat, null, $user_ids, $user);
                try {
                    $percentNumber = $ads->count() / $total_Ads->count() * 100;
                } catch (\Exception $e) {
                    $percentNumber = 0;
                }
                $categories['id'] = $cat->id;
                $categories['title'] = $cat->title;
                $categories['image'] = $cat->image;
                $subCats[] = (new CategoryDisplayInShops($cat))->foo($ads->count(), $percentNumber);
                $categories['subCategories'] = $subCats;
            }
        }
        $ads = $this->adRepository->adsOfAgency($category, $nodes, $user_ids, $user);
        $tag = $request->search;

        $ads->where('uniqueCodeOfAd', 'LIKE', '%' . $tag . '%')
            ->orWhere('title', 'LIKE', '%' . $tag . '%');
        $ads = $ads->paginate(10);

        return response()->json([
            'status_code' => 200,
            'data' =>
                [
                    'ads' => new AdCollection($ads),
                    'total' => $ads->total(),
                    'path' => $ads->path(),
                    'perPage' => $ads->perPage(),
                    'currentPage' => $ads->currentPage(),
                    'lastPage' => $ads->lastPage(),
                    'categories' => $categories,
                    'shop' => new Shop($user),
                ],


        ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 403,
                'errors' => [],
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function search(Request $request)
    {
        $background_default_photo = Setting::where('title', 'shop_default_photo_in_app')->first()->str_value;

//        $tags=[];
//        $cities = City::all();
//        $neighborhoods = Neighborhood::all();
        $tag = $request->search;
//        $shop_default_photo = Setting::where('title', 'shop_default_photo')->first()->str_value;
//        $shop_default_logo = Setting::where('title', 'shop_default_logo')->first()->str_value;
        $user_ids = DB::table('role_user')->where('role_id', Role::where('slug', 'real-state-administrator')->first()->id)
            ->pluck('user_id')->toArray();
        $shops = User::where('shop_active', 'active')->whereIn('id', $user_ids)->where('shop_title', 'LIKE', '%' . $tag . '%')->paginate(8);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => new ShopCollection($shops),
                'backgroundPhoto' => isset($background_default_photo) ? url($background_default_photo) : '',
                'total' => $shops->total(),
                'path' => $shops->path(),
                'perPage' => $shops->perPage(),
                'currentPage' => $shops->currentPage(),
                'lastPage' => $shops->lastPage(),
            ],
        ]);
//        return view('Users::user.shop.index', compact('shops', 'cities', 'neighborhoods', 'shop_default_photo', 'shop_default_logo', 'tags'));
    }

}

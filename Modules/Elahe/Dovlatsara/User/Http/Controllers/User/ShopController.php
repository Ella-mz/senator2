<?php

namespace Modules\User\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\ActivityRange\Repositories\ActivityRangeRepository;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Repositories\AdRepository;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Attribute\Entities\Attribute;
use Modules\AttributeItem\Entities\AttributeItem;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Entities\City;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Entities\Level2CategoryOfAgency;
use Modules\User\Entities\User;
use Modules\User\Http\Traits\ShopCardTrait;
use Modules\User\Repositories\UserRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class ShopController extends Controller
{
    use ShopCardTrait, GetGroupAttributeTrait;

    private $adRepository;
    private $userRepository;
    private $settingRepository;
    private $categoryRepository;
    private $activityRangeRepository;
    private $advertisingRepository;
    private $advertisingApplicationRepository;
    private $articleRepository;

    public function __construct(AdRepository $adRepository, UserRepository $userRepository,
                                SettingRepository $settingRepository, ActivityRangeRepository $activityRangeRepository,
                                CategoryRepository $categoryRepository, AdvertisingRepository $advertisingRepository,
                                AdvertisingApplicationRepository $advertisingApplicationRepository, ArticleRepository $articleRepository)
    {
        $this->adRepository = $adRepository;
        $this->userRepository = $userRepository;
        $this->settingRepository = $settingRepository;
        $this->categoryRepository = $categoryRepository;
        $this->activityRangeRepository = $activityRangeRepository;
        $this->advertisingRepository = $advertisingRepository;
        $this->advertisingApplicationRepository = $advertisingApplicationRepository;
        $this->articleRepository = $articleRepository;
    }

    public function index(Request $request)
    {
        $search = '';
        $tags = [];
        $user_ids = $this->userRepository->userIdsFindByRole('real-state-administrator');
//        $user_ids = Role::where('slug', 'real-state-administrator')->pluck('user_id')->toArray();
        $shops = User::where('shop_active', 'active')->whereIn('id', $user_ids)->orderByDesc('created_at');
        $shop_ids1 = [];
        $shop_ids2 = [];
        if (session('cities')) {
            $shop_ids1 = $shops->whereIn('shop_city_id', session('cities'))->pluck('id')->toArray();
            $activityRange_user_ids1 = ActivityRange::whereIn('city_id', session('cities'))->pluck('user_id')->toArray();
            $shop_ids2 = $shops->whereIn('id', $activityRange_user_ids1)->pluck('id')->toArray();
            $shop_ids1 = array_unique(array_merge($shop_ids1, $shop_ids2));
        }
        if (count($shop_ids1) > 0)
            $shops = User::whereIn('id', $shop_ids1);
        $shop_default_photo = $this->settingRepository->getSettingByTitle('shop_default_photo')->str_value;
        $shop_default_logo = $this->settingRepository->getSettingByTitle('shop_default_logo')->str_value;

        if (isset($request->city) || isset($request->neighborhood)
            || isset($request->cityModal) || isset($request->neighborhoodModal)) {


            if (isset($request->city)) {
                $activityRange_user_ids = $this->activityRangeRepository->userIdsFindByCityId($request->city);
//                $shops = $shops->whereIn('id', $activityRange_user_ids)->orWhere('shop_city_id', $request->city);
                $shops = $shops->where('shop_city_id', $request->city);
                array_push($tags, City::find($request->city)->title);
            }
            if (isset($request->neighborhood)) {
                $neighborhoodArr = [];
                foreach (($request->neighborhood) as $neighborhood) {
                    array_push($neighborhoodArr, $neighborhood);
                    array_push($tags, Neighborhood::find($neighborhood)->title);
                }
                $activityRange_user_ids = $this->activityRangeRepository->userIdsFindByNeighborhoodIds($neighborhoodArr);
                $shops = $shops->whereIn('id', $activityRange_user_ids);
            }
            if (isset($request->cityModal)) {
                $activityRange_user_ids = $this->activityRangeRepository->userIdsFindByCityId($request->cityModal);
//                $shops = $shops->whereIn('id', $activityRange_user_ids)->orWhere('shop_city_id', $request->cityModal);
                $shops = $shops->where('shop_city_id', $request->cityModal);
                array_push($tags, City::find($request->cityModal)->title);
            }
            if (isset($request->neighborhoodModal)) {
                $neighborhoodArr = [];
                foreach (($request->neighborhoodModal) as $neighborhood) {
                    array_push($neighborhoodArr, $neighborhood);
                    array_push($tags, Neighborhood::find($neighborhood)->title);
                }
                $activityRange_user_ids = $this->activityRangeRepository->userIdsFindByNeighborhoodIds($neighborhoodArr);
                $shops = $shops->whereIn('id', $activityRange_user_ids);
            }
            $shop_ids = $shops->pluck('id')->toArray();
            $shops = User::whereIn('id', $shop_ids)->get();
            $content = $this->shopCard($shops, $shop_default_photo, $shop_default_logo);
            $tag = $this->shopTag($tags);

            return response()->json(['content' => $content, 'tags' => $tag]);
        }

        $cities = City::all();
        if (isset($request->category)) {
            $shops = $shops->where('category_id', $request->category);
        }
        $shops = $shops->get();
        if (isset($request->search)) {
            $search = $request->search;
            $shops = $shops->filter(function ($item) use ($search) {
                return strstr($item->shop_title, $search);
            });
        }

        $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('RealestatePage');
        $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
        $categories = $this->categoryRepository->categoryDepth1();
        return view('Users::user.shop.index2', compact('shops', 'shop_default_photo', 'shop_default_logo', 'cities',
            'tags', 'advertisement', 'categories', 'search'));
    }

    public function show($slug, Request $request)
    {
        $user = $this->userRepository->userFindBySlug($slug);
        if (!$user) {
            alert()->error('', 'نامک وارد شده اشتباه است');
            return redirect()->back();
        }

        if ($user->hasRole('real-state-administrator')) {
            $real_estate_agents = $this->userRepository->agents($user->id);
            $user_ids = $real_estate_agents->pluck('id')->toArray();
            $category = $this->categoryRepository->categoryFindById($user->category_id);
            $userCategories = Category::whereIn('id', Level2CategoryOfAgency::where('user_id', $user->id)->pluck('category_id')->toArray())->get();
            $attributeGroups = null;
            if ($category) {
                $childCats = $this->getLastNodewithItself($category);
                $cats = $this->categoryRepository->nodeCatsWithIds($childCats)->pluck('id')->toArray();
                $attributeGroups = $this->getAttributeGroups($category->id, 'supplier');
            }
            array_push($user_ids, $user->id);
            $nodes = $this->categoryRepository->nodeIds();
            //$this->adRepository->adsOfAgency($category, $nodes, $user_ids, $user);
            $ads = $this->adRepository->adsOfAgency($category, $nodes, $user_ids, $user);
//            $ads = Ad::with('attributes')->whereIn('category_id', $category ? $category->allNodesIds() : $nodes)
//                ->where('agency_id', $user->id)->where('request_to_agency', '!=', 'pending')
//                ->where(function ($query) use ($user_ids) {
//                    $query->where('advertiser', 'supplier')->where('endDate', '>', Carbon::now())
//                        ->where('active', 'active')->where('userStatus', 'active')
//                        ->where('isPaid', 'paid');
//                })->orWhere(function ($query) use ($user_ids) {
//                    $query->where('advertiser', 'supplier')->where('endDate', '>', Carbon::now())
//                        ->where('active', 'active')->where('userStatus', 'onlyEstatePanel')
//                        ->where('isPaid', 'paid');
//                })->orderByDesc('created_at');
            $ad_ids2 = $ads->pluck('id');
            $adAttributes = $this->adRepository->adAttributeWithAdIds($ad_ids2);
            if (isset($request->attributeTypeSelect) || isset($request->search)) {
                if (isset($request->search)) {
                    $tag = $request->search;
                    $ads = $ads->get()->filter(function ($item) use ($tag) {
                        return strstr($item->title, $tag);
                    });
                    $ads = Ad::whereIn('id', $ads->pluck('id')->toArray());
                }

                if (isset($request->attributeTypeSelect)) {

                    $ads = $this->selectFilter($request->attributeTypeSelect, $adAttributes, $ads);
                }
                $content = $this->supplierCard($ads->get());
                return response()->json(['content' => $content,]);
            }
            $shop_default_photo = $this->settingRepository->getSettingByTitle('shop_default_photo')->str_value;
            $shop_default_logo = $this->settingRepository->getSettingByTitle('shop_default_logo')->str_value;
            $user_default_photo = $this->settingRepository->getSettingByTitle('user_default_photo')->str_value;
            $ad_default_photo = $this->settingRepository->getSettingByTitle('ad_default_photo')->str_value;
            $emergency_label = $this->settingRepository->getSettingByTitle('emergency_label')->str_value;
            $ads = $ads->get();
            $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('AgencyPageDetail');
            $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
            $articles = $this->articleRepository->articlesOfAgency($user->id);
            return view('Users::user.shop.show2', compact('ads',
                'shop_default_photo', 'shop_default_logo', 'user', 'userCategories',
                'real_estate_agents', 'user_default_photo', 'category', 'attributeGroups', 'advertisement',
                'articles', 'ad_default_photo', 'emergency_label'));
        } elseif ($user->hasRole('contractor')) {
            $contractor_men_default_photo = $this->settingRepository->getSettingByTitle('contractor_men_default_photo')->str_value;
            $contractor_women_default_photo = $this->settingRepository->getSettingByTitle('contractor_women_default_photo')->str_value;
            if ($user->hasRole('contractor')) {

                return view('Users::user.contractor.show', compact('user', 'contractor_women_default_photo', 'contractor_men_default_photo'));
            } else
                return redirect()->back();
        } else
            return redirect()->back();
    }

    public function selectFilter($attributeTypeSelect, $adAttributes, $ads)
    {
        $selectAttribute = [];
        foreach ($attributeTypeSelect as $key => $attr1) {

//            if (array_search(!null, array_values($attr1))) {
            $adAttributes = $adAttributes->where('attribute_id', $key)->whereIn('attribute_item_id', $attr1);
            $ad_idss = $ads->pluck('id')->toArray();
            foreach ($adAttributes->pluck('id')->toArray() as $attr_item) {
                array_push($selectAttribute, $attr_item);
            }
            $ad_idsss = DB::table('ad_attribute')->whereIn('id', $selectAttribute)->pluck('ad_id')->toArray();
            $ads = Ad::whereIn('id', array_intersect($ad_idss, $ad_idsss));
//            }
        }
        return $ads;
    }

    public function chartOfCats(Request $request)
    {
        $category = $this->categoryRepository->categoryFindById($request->cat_id);
        $content = '';
        $agency_id = $request->agency_id;
        $real_estate_agents = $this->userRepository->agents($this->userRepository->userFindById($agency_id));
        $user_ids = $real_estate_agents->pluck('id')->toArray();
        $total_Ads = $this->categoryRepository->categoryFindById($request->parent_cat)->allAdsOfParentCategory($agency_id);
        $colors = ['#d73a49', '#23afe3', '#28a745', '#ffd33d', '#6f42c1', '#04ca9a', '#0366d6', '#f66a0a', '#999999', '#196c64', '#000000'];
        if ($category->categories->count() > 0) {
            foreach ($category->categories as $key => $childNode) {
                $ads = $this->adRepository->adsOfAgency($childNode, null, $user_ids, $this->userRepository->userFindById($agency_id));
                try {
                    $percentNumber = $ads->count() / $total_Ads->count() * 100;
                } catch (\Exception $e) {
                    $percentNumber = 0;
                }
                $content .= '<div class="col-lg-2 col-md-3 col-sm-4 col-6"><div class="skill-item center-block"><div class="chart-container">';
                $content .= '<div class="chart " data-percent="' . $percentNumber . '" data-bar-color="' . $colors[$key] . '"><p class="d-none">';
                $content .= $percentNumber . '</p><span class="percent">' . $ads->count() . '</span></div>';
                $content .= '<p>' . $childNode->title . '</p></div></div></div>';
            }
            return json_encode(['content' => $content]);

        } else {
            $ads = $this->adRepository->adsOfAgency($category, null, $user_ids, $this->userRepository->userFindById($agency_id));
            try {
                $percentNumber = $ads->count() / $total_Ads->count() * 100;
            } catch (\Exception $e) {
                $percentNumber = 0;
            }
            $content .= '<div class="col-lg-2 col-md-3 col-sm-4 col-6"><div class="skill-item center-block"><div class="chart-container">';
            $content .= '<div class="chart " data-percent="' . $percentNumber . '" data-bar-color="#d73a49"><p class="d-none">' . $percentNumber;
            $content .= '</p><span class="percent">' . $ads->count() . '</span></div>';
            $content .= '<p>' . $category->title . '</p></div></div></div>';
            return json_encode(['content' => $content]);
        }
    }

    public function supplierCard($ads)
    {
        $content = '';
        foreach ($ads as $ad) {
            $content .= '<div class=" col-xl-4 col-sm-6 mb-5 d-flex justify-content-center flex-column align-items-center">';
            $content .= '<div class="productShowCard"><div class="productShow-img">';
            if (isset($ad->adImages->first()->image)) {
                $content .= '<img src="' . asset($ad->adImages->first()->image) . '" alt="">';
            } elseif (isset(Setting::where('title', 'ad_default_photo')->first()->str_value))
                $content .= '<img src="' . asset(Setting::where('title', 'ad_default_photo')->first()->str_value) . '" alt="">';
            else
                $content .= '<img src="' . asset('files/userMaster/assets/img/images.jpg') . '" alt="">';
            $content .= '<div class="pro-option"><ul><li class="hologram-img-color">';
            if (HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()
                && HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->status == 'approved')
                $content .= '<img src="' . asset(HologramInterface::where('type_id', $ad->id)->where('type', 'ad')->first()->hologram->logo) . '" alt=""></li>';
            else
                $content .= '</li>';
            $content .= '<li class="hologram-img-text">';
            if ($ad->type == 'emergency') {
                $content .= '<img src="' . asset(Setting::where('title', 'emergency_label')->first()->str_value) . '" alt="" class="option-img"></li>';
            } else
                $content .= '</li>';
            $content .= '</ul></div></div><div class="productShow-desc"><div class="product-id"><span>کد آگهی: <span>' . $ad->uniqueCodeOfAd . '</span></span>';
            $content .= '</div><div class="productShow-desc-name"><h3>' . $ad->title . '</h3><p>';
            $content .= ($ad->user->shop_active == 'active') ? $ad->user->shop_title : '';
            $content .= '</p></div>';
            $content .= '<div class="productShow-desc-option"><ul><li><div><img src="' . asset('files/userMaster/assets/img/placeholder.png') . '" alt="">';
            $content .= '<span>';
            if (isset($ad->neighborhood_id))
                $content .= $ad->neighborhood->title;
            else
                $content .= $ad->city->title;
            $content .= '</span></div></li>';
            if ($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'select')->first()) {
                $content .= '<li><div><img src="' . asset('files/userMaster/assets/img/home.png') . '" alt=""><span>';
                $content .= AttributeItem::where('id', $ad->attributes->where('isSignificant', 1)
                        ->where('attribute_type', 'select')->first()->pivot->attribute_item_id)->first()->title . '</span></div></li>';
            }
            $content .= '</ul>';
            $content .= '<a href="' . route('ad.show.supplier.user', $ad->id) . '" class="mainLink"></a>';
            $content .= '</div>';
            $content .= '<div class="productShow-desc-price">';
            if ($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()) {
                if (isset($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value)) {
                    $content .= '<p>' . number_format($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->pivot->value);
                    $content .= ' ' . Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->unit . '</p>';

                } else {
                    $content .= '<p>' . Attribute::find($ad->attributes->where('isSignificant', 1)->where('attribute_type', 'int')->first()->id)->alt_value . '</p>';

                }
            }
            $content .= '</div></div></div></div>';
        }
        return $content;
    }


}

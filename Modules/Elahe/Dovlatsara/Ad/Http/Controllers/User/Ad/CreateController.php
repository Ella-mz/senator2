<?php

namespace Modules\Ad\Http\Controllers\User\Ad;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Http\Requests\User\StoreRequest;
use Modules\Ad\Repositories\CatalogRepository;
use Modules\Ad\Traits\StoreSupplierAdTrait;
use Modules\Ad\Repositories\AdRepository;
use Modules\AdFee\Entities\AdFee;
use Modules\Attribute\Entities\Attribute;
use Modules\Category\Entities\Category;
use Modules\City\Entities\City;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\EnumType\Repositories\EnumTypeRepository;
use Modules\Map\Traits\NeshanTrait;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\Setting\Repository\AdminSettingRepository;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Entities\Level2CategoryOfAgency;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;
use RealRashid\SweetAlert\Facades\Alert;

class CreateController extends Controller
{
    use GetGroupAttributeTrait, StoreSupplierAdTrait, NeshanTrait;

    private $repo;
    private $adminSettingRepository;
    private $settingRepository;
    private $walletRepository;
    private $catalogRepository;
    private $enumTypeRepository;

    public function __construct(AdRepository $adRepository, AdminSettingRepository $adminSettingRepository,
                                SettingRepository $settingRepository, WalletRepository $walletRepository,
                                CatalogRepository $catalogRepository, EnumTypeRepository $enumTypeRepository)
    {
        $this->repo = $adRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->settingRepository = $settingRepository;
        $this->walletRepository = $walletRepository;
        $this->catalogRepository = $catalogRepository;
        $this->enumTypeRepository = $enumTypeRepository;
    }

    /**
     * @param Category $category
     * @return View
     */
    public function index(Category $category): View
    {
        $agency_id = (request('agencyId'));
        $hasSpecial = $this->repo->adminSetting('hasSpecial');
        $hasScalar = $this->repo->adminSetting('hasScalar');
        $hasEmergency = $this->repo->adminSetting('hasEmergency');
        $cities = $this->repo->cities();
        $attributeGroups = $this->getAttributeGroups($category->id, 'supplier');


        $grandCategory_id = $category->getGrandParent();
        $content = '';

        $attributeGroups = $attributeGroups->whereIn('advertiser', ['supplier', 'both'])->pluck('id')->toArray();
        $attributeGroups = $this->repo->attributeGroupsById($attributeGroups);

        $inputSession = \session('adParams');
        $api_key = $this->neshan_get_api_key();
        $sdk_key = $this->neshan_get_SDK_key();
        $latitude = null;
        $longitude = null;
        $mapCenter = [];
        if (isset($this->settingRepository->getSettingByTitle('latitude')->str_value) && isset($this->settingRepository->getSettingByTitle('longitude')->str_value))
            $mapCenter = [(float)$this->settingRepository->getSettingByTitle('latitude')->str_value, (float)$this->settingRepository->getSettingByTitle('longitude')->str_value];
        if (isset($this->settingRepository->getSettingByTitle('video_image_for_display_in_upload')->str_value))
            $video_image_for_display_in_upload = $this->settingRepository->getSettingByTitle('video_image_for_display_in_upload')->str_value;
        else
            $video_image_for_display_in_upload = 'files/userMaster/assets/img/video-back-ground.png';

        return view('Ads::user.ad.create.singlePage',
            compact('cities', 'category', 'attributeGroups', 'content', 'video_image_for_display_in_upload',
                'hasSpecial', 'hasEmergency', 'hasScalar', 'inputSession', 'agency_id', 'api_key', 'sdk_key', 'latitude',
                'longitude', 'mapCenter'));
    }

    public function store(StoreRequest $request, Category $category)
    {
        \session(['adParams' => $request->except(['adImage', 'catalog'])]);
        \session(['backUrl' => $request->url()]);
        $duration_of_ads = $this->settingRepository->getSettingByTitle('duration_of_ads')->str_value;

        $errors = [];

        if ($request->attribute != null) {
            foreach ($request->attribute as $key => $attribute) {
                if (!isset($attribute['alt'])) {
                    if (Attribute::where('id', $key)->first()->isFilterField == 1 && ($attribute['main'] == null)
                        && (Attribute::where('id', $key)->first()->attribute_type != 'bool')) {
                        $errors += ['مشخصه  ' . Attribute::where('id', $key)->first()->title . ' الزامی است.'];
//                        return back()->with('message2', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' الزامی است.')->withInput();
                    }
                }
            }
            if (count($errors) > 0) {
                session(['message2' => $errors]);
                return back()->with($errors);
            }
            foreach ($request->attribute as $key => $attribute) {
                if (Attribute::where('id', $key)->first()->isFilterField == 1) {
                    if (!isset($attribute['alt'])) {
                        if (Attribute::where('id', $key)->first()->attribute_type == 'int'
                            && (!is_numeric(str_replace(',', '', $attribute['main'])))) {
                            return back()->with('message3', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' باید به صورت عدد وارد شود است.')->withInput();
                        }
                    }
                } else {
                    if (isset($attribute['main']) && $attribute['main'] != null) {
                        if (Attribute::where('id', $key)->first()->attribute_type == 'int' && (!is_numeric(str_replace(',', '', $attribute['main'])))) {
                            return back()->with('message3', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' باید به صورت عدد وارد شود است.')->withInput();
                        }
                    }
                }
            }
        }
        if (!\auth()->check())
            return redirect()->route('auth.loginForm.user');

        if ($request->adType == 'general')
            $submit_score = $this->enumTypeRepository->findEnumTypeByTitle('submit_general_ad_score')->link;
        elseif ($request->adType == 'scalar')
            $submit_score = $this->enumTypeRepository->findEnumTypeByTitle('submit_scalar_ad_score')->link;
        else
            $submit_score = $this->enumTypeRepository->findEnumTypeByTitle('submit_emergency_ad_score')->link;

        $paymentSituation = $this->checkTheSituationOfStoreAd($submit_score, $category);

        if ($paymentSituation['status'] == 'free') {
            $ad = $this->storeAdWithAttrsAndImages($request->all(), $category);
            if (isset($request->catalog))
                $this->catalogRepository->uploadCatalog($ad, $request, \auth()->user());

            $ad->update([
                'paymentType' => 'free',
                'isPaid' => 'paid',
                'endDate' => Carbon::now()->add($duration_of_ads, 'day'),
            ]);
        } elseif ($paymentSituation['status'] == 'membership') {
            $ad = $this->storeAdWithAttrsAndImages($request->all(), $category);
            if (isset($request->catalog))
                $this->catalogRepository->uploadCatalog($ad, $request, \auth()->user());
            $ad->update([
                'paymentType' => 'membership',
                'isPaid' => 'paid',
                'endDate' => Carbon::now()->add($duration_of_ads, 'day'),
            ]);
            $request->session()->forget('adParams');
        } elseif ($paymentSituation['status'] == 'adFee') {
            $validator = Validator::make($request->all(), [
                'adPaymentFee' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $ad = $this->storeAdWithAttrsAndImages($request->all(), $category);
            if (isset($request->catalog))
                $this->catalogRepository->uploadCatalog($ad, $request, \auth()->user());
            $advertisingFee = $this->repo->adFeeFindById($request->adPaymentFee);
            if (($ad->type == 'general' && $advertisingFee->generalAdFee != 0) ||
                ($ad->type == 'scalar' && $advertisingFee->scalarAdFee != 0) ||
                ($ad->type == 'special' && $advertisingFee->specialAdFee != 0) ||
                ($ad->type == 'emergency' && $advertisingFee->emergencyAdFee != 0)) {
                $ad->update([
                    'paymentType' => 'adFee',
                    'endDate' => Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'),
                ]);
                $request->session()->forget('adParams');
                $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());
                Alert::success('', 'آگهی با موفقیت ثبت شد');

                return view('AdFees::user.payAdFee', compact('advertisingFee', 'ad', 'current_balance'));
            } else {
                $ad->update([
                    'paymentType' => 'free',
                    'isPaid' => 'paid',
                    'endDate' => Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'),
                ]);
                $request->session()->forget('adParams');
                Alert::success('', 'آگهی با موفقیت ثبت شد');
                return redirect(route('ad.myPosts.supplier.user'));
            }
        }
        $request->session()->forget('adParams');
        Alert::success('', 'آگهی با موفقیت ثبت شد');
        return redirect(route('ad.myPosts.supplier.user'));
    }

    public function checkTheSituationOfStoreAd($score, $category): array
    {
//        $parentCat = $category->getGrandParent();
        $status = [];
//        if ($request['advertiser']==1){
//            if (Setting::first()->isFreeSupplierSubmit == 0) {
//                return $status=['status'=>'free'];
//            }
//        }else{
//            if (Setting::first()->isFreeApplicantSubmit == 0) {
//                return $status=['status'=>'free'];
//            }
//        }
        if (AdFee::where('category_id', $category->id)->count() == 0) {
            return $status = ['status' => 'free'];
        } else {
            $mem_ship = \auth()->user()->memberships()
                ->wherePivot('startDate', '<=', Carbon::now())
                ->wherePivot('endDate', '>', Carbon::now())
                ->first();
//            Ad::where('user_id', \auth()->id())->where('paymentType', 'membership')
//                ->where('active', 'active')->where('advertiser', 'supplier')
//                ->where('endDate', '>=', Carbon::now())->where('isPaid', 'paid')->get()->count() >
//            DB::table('membership_user')->where('user_id', \auth()->id())
//                ->where('membership_id', $mem_ship->id)
//                ->where('startDate', '<=', Carbon::now())
//                ->where('endDate', '>', Carbon::now())->first()->number_of_allowed_ads
            if ($mem_ship) {
                $user_membership = DB::table('membership_user')->where('user_id', \auth()->id())
                    ->where('membership_id', $mem_ship->id)
                    ->where('startDate', '<=', Carbon::now())
                    ->where('endDate', '>', Carbon::now())->first();
                if ($user_membership->remain_score > 0 && ($user_membership->remain_score >= $score)) {
                    $user_membership->update(['remain_score' => $user_membership->remain_score - $score]);
                    return $status = ['status' => 'membership'];

                } else {
                    return $status = ['status' => 'adFee'];
                }
            } else
                return $status = ['status' => 'adFee'];

        }
    }

    public
    function sendLatlngToApi()
    {

        $lat = request('lat1');
        $lng = request('lng1');

        $x = ['x-api-key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkwZTNjZDg2MDY0NDYyY2UyNzYzNmIxNWMxNTdhZjYxM2RiZmI3ZTM2MDg0ZWU2NmNmMjc1Y2I2ZGRkMjgxYWVkMjdjMDJlOTFiZjIzMDVhIn0.eyJhdWQiOiIxNDAyMSIsImp0aSI6IjkwZTNjZDg2MDY0NDYyY2UyNzYzNmIxNWMxNTdhZjYxM2RiZmI3ZTM2MDg0ZWU2NmNmMjc1Y2I2ZGRkMjgxYWVkMjdjMDJlOTFiZjIzMDVhIiwiaWF0IjoxNjIxMjMzMDE1LCJuYmYiOjE2MjEyMzMwMTUsImV4cCI6MTYyMzgyNTAxNSwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.g-oaFkPxTsmJka5HczgcUvJMmuM6HKdrJgEaVyHWzNXu3UmkOjWch_d8nf0OIOQqKSG6I-KpjMYVEfj1KRH9iI4x9HYilH9qSq8epsUElbWuS6OLTCS3i_a-CCgelms3qFvbnik7tkfw_7f41zCZRxO-8w1h-41QkOMVtXLalZF-R7khLb5PShh75lo60Iezy9eEpoIZduQe2GlF_yjHMI8oLC9ZSLeH03Qw5UvjycPyEpYhwBUiqK9THv4mAnsKt89EjwENDcaWxxFS1uymGfbi2tdpE1tiT0QgUkVsFHvwivBCDRIf3eLIVXmY2ryi7LlKNmDfScWqCN11u_ZRMA'
            , 'lat' => $lat, 'lon' => $lng];

//        $x = ['lat'=>$lat, 'lon'=>$lng,'x-api-key'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjdkZjRlN2JhMzBhODNiMTUyNTIyYTM2ZjJkMGM1N2NkNDBmMDYyNTg5NWE3MTlmNWRhNjQyZjJiNjhkMjJhYjdiOTI1OGM4YTE0ZWM1NDFjIn0.eyJhdWQiOiIxMzg3NyIsImp0aSI6IjdkZjRlN2JhMzBhODNiMTUyNTIyYTM2ZjJkMGM1N2NkNDBmMDYyNTg5NWE3MTlmNWRhNjQyZjJiNjhkMjJhYjdiOTI1OGM4YTE0ZWM1NDFjIiwiaWF0IjoxNjIwNDU4ODM5LCJuYmYiOjE2MjA0NTg4MzksImV4cCI6MTYyMzA1MDgzOSwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.jcAFSOY3xkCwQOoEnHFfE4_1EGXHuFuw6S_6NKel6G7RGASHuAlCX-s6QmnQX-jkdHCIn-IWc4KUz-5PRfEIj3ss1oShi1sGWkBjh0V68T9tmEpyyRmQNeL_z5jI5rCKgfcsKetn3bnYc_45gQtGkBRPslZKQO-NC3A_0zWEQ2wD6O0Fv11y_Yl33INk99KJgzo8VUTjlkceifdeNRq0D89xSgsxybwFZEbsbAQQgFem14rOca2iznJ-2rxApUAfvYBp13DS55FJ-OxqwvU8tzUEM4iaZ69hvViblr85EKQ2-HKHMMniJ0yl8Z5m7RQveI47FVlg2DXxa46kEyYQkg'
//            ,'lat'=>$lat, 'lon'=>$lng];
//        $latlng =
//        $response = Http::get('https://map.ir/reverse?lat=35.67180064238771&lon=51.409835815429695');
        $response = Http::get('https://map.ir/reverse', $x);

        return json_encode(array('rural_district' => $response->json()['rural_district'], 'primary' => $response->json()['primary'], 'name' => $response->json()['name'], 'address' => $response->json()['address'], 'region' => $response->json()['region'], 'county' => $response->json()['county'], 'neighborhood' => $response->json()['neighbourhood'], JSON_UNESCAPED_UNICODE));
    }

    public function neighborhoodOld(Request $request)
    {
        $city = City::find($request->cityId);
        $neighborhood = Neighborhood::find($request->neighborhoodId);
        $content = '';
        $content .= '<div><label> محله</label><select name="neighborhood" class="full" style="height: 45px">';
        foreach ($city->neighborhoods as $neighbor) {
            if ($neighbor->id == $neighborhood->id) {
                $content .= '<option value="' . $neighbor->id . '" selected>' . $neighbor->title . '</option>';
            } else
                $content .= '<option value="' . $neighbor->id . '">' . $neighbor->title . '</option>';
        }
        $content .= '</select></div>';
        return json_encode(['content' => $content]);
    }

    public function selectCategoryLevel2($type, Request $request)
    {
        $category_id = collect(request('categoryId'));
        $agency_id = $request->agency_id;
        if (count($category_id))
            $cat = Category::where('id', Category::where('id', $category_id)->first()->id)->first();
        $content = '';
        if (Category::where('id', $category_id)->first()->depth == 1) {
            $catIds = Level2CategoryOfAgency::where('user_id', $agency_id)->pluck('category_id')->toArray();
            $cats = Category::whereIn('id', $catIds)->orderBy('order', 'asc')->get();
            return view('Ads::user.ad.create.selectCategory2',
                compact('cats', 'type', 'agency_id'));
        } else {
            $cats = $cat->categories()->orderBy('order', 'asc')->get();
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

    public
    function prevCatsLevel2($type, Request $request)
    {
        $category_id = collect(request('categoryId'));
        $agency_id = $request->agencyId;
        $cat = Category::where('id', Category::where('id', $category_id)->first()->id)->first();
        if ($cat->depth == 1) {
            $cat2 = $cat;
            $cats = Category::where('depth', 1)->orderBy('order', 'asc')->get();
        } elseif ($cat->depth == 2) {
            $cat2 = $cat->category()->first();
            $catIds = Level2CategoryOfAgency::where('user_id', $agency_id)->pluck('category_id')->toArray();
            $cats = Category::whereIn('id', $catIds)->orderBy('order', 'asc')->get();
        } else {
            $cat2 = $cat->category()->first();
            $cats = $cat2->categories()->orderBy('order', 'asc')->get();
        }
        $content = '';
        if (count($cats)) {
            if ($cat->category->parent_id != 0)
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
}

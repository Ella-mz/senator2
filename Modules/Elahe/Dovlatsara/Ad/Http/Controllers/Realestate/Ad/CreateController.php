<?php

namespace Modules\Ad\Http\Controllers\Realestate\Ad;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Http\Requests\User\StoreRequest;
use Modules\Ad\Repositories\CatalogRepository;
use Modules\Ad\Traits\StoreSupplierAdTrait;
use Modules\Ad\Repositories\AdRepository;
use Modules\AdFee\Entities\AdFee;
use Modules\Attribute\Entities\Attribute;
use Modules\Category\Entities\Category;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\EnumType\Repositories\EnumTypeRepository;
use Modules\Map\Traits\NeshanTrait;
use Modules\Setting\Repository\AdminSettingRepository;
use Modules\Setting\Repository\SettingRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;
use RealRashid\SweetAlert\Facades\Alert;

class CreateController extends Controller
{
    use GetGroupAttributeTrait, StoreSupplierAdTrait, NeshanTrait;

    public $repo;
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
        $hasSpecial = $this->repo->adminSetting('hasSpecial');
        $hasScalar = $this->repo->adminSetting('hasScalar');
        $hasEmergency = $this->repo->adminSetting('hasEmergency');

        $cities = $this->repo->cities();
        $attributeGroups = $this->getAttributeGroups($category->id, 'supplier');
        $grandCategory_id = $category->getGrandParent();
        $content = '';

        $attributeGroups = $attributeGroups->whereIn('advertiser', ['supplier', 'both'])->pluck('id')->toArray();
        $attributeGroups = $this->repo->attributeGroupsById($attributeGroups);
        $api_key = $this->neshan_get_api_key();
        $sdk_key = $this->neshan_get_SDK_key();
        $latitude = null;
        $longitude = null;
        $mapCenter=[];
        if (isset($this->settingRepository->getSettingByTitle('latitude')->str_value) && isset($this->settingRepository->getSettingByTitle('longitude')->str_value))
            $mapCenter = [(float)$this->settingRepository->getSettingByTitle('latitude')->str_value, (float)$this->settingRepository->getSettingByTitle('longitude')->str_value];

        return view('Ads::realestate.createSinglePage',
            compact('cities', 'category', 'attributeGroups', 'content', 'hasScalar',
                'hasEmergency', 'hasSpecial', 'sdk_key', 'api_key', 'mapCenter', 'latitude', 'longitude'));
    }

    public function store(StoreRequest $request, Category $category)
    {
        $duration_of_ads = $this->settingRepository->getSettingByTitle('duration_of_ads')->str_value;
        if ($request->attribute != null) {
            foreach ($request->attribute as $key => $attribute) {
                if (!isset($attribute['alt'])) {
                    if (Attribute::where('id', $key)->first()->isFilterField == 1 && ($attribute['main'] == null)
                        && (Attribute::where('id', $key)->first()->attribute_type != 'bool')) {
                        return back()->with('message2', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' الزامی است.')->withInput();
                    }
                }
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
        } elseif ($paymentSituation['status'] == 'adFee') {
            $validator = Validator::make($request->all(), [
                'adPaymentFee' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $ad = $this->storeAdWithAttrsAndImages($request->all(), $category);
            if (isset($request->catalog))
                $this->catalogRepository->uploadCatalog($ad, $request, \auth()->user());
            $advertisingFee = $this->repo->adFeeFindById($request->adPaymentFee);
            if (($ad->type=='general' && $advertisingFee->generalAdFee!=0) || ($ad->type=='scalar' && $advertisingFee->scalarAdFee!=0) ||
                ($ad->type=='special' && $advertisingFee->specialAdFee!=0) || ($ad->type=='emergency' && $advertisingFee->emergencyAdFee!=0)) {
                $ad->update([
                    'paymentType' => 'adFee',
                    'endDate' => Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'),
                ]);
                $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());
                Alert::success('', 'آگهی با موفقیت ثبت شد');
                return view('AdFees::realestate.payAdFee', compact('advertisingFee', 'ad', 'current_balance'));
            }else{
                $ad->update([
                    'paymentType' => 'free',
                    'isPaid' => 'paid',
                    'endDate' => Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'),
                ]);
                Alert::success('', 'آگهی با موفقیت ثبت شد');
                return redirect(route('ad.index.supplier.realestate', \auth()->id()));
            }
        }
        Alert::success('', 'آگهی با موفقیت ثبت شد');
        return redirect(route('ad.index.supplier.realestate', \auth()->id()));
    }


//    public function selectCategory($type)
//    {
//        $category_id = collect(request('categoryId'));
//
//        if (count($category_id))
//            $cat = Category::where('id', Category::where('id', $category_id)->first()->id)->first();
//        $content = '';
//        if (!count($category_id)) {
//            $cats = Category::where('depth', 1)->orderBy('order', 'asc')->get();
//            return view('Ads::realestate.selectCategory',
//                compact('cats', 'type'));
//        } else {
//            $cats = $cat->categories()->orderBy('order', 'asc')->get();
//            if (count($cats)) {
//                $content .='<li class="li-bg-gray" onclick="prevCats(this.id)" id="'. $cat->id . '"><span>بازگشت به '.$this->repo->findCategoryById($cat->id)->title .'</span><i class="fa fa-angle-right"></i></li>';
//                foreach ($cats as $key=>$c) {
//                    if ($key%2==0)
//                    {
//                        $content.='<li class="li-bg-light-gray" onclick="nextCats(this.id)" id="'. $c->id . '"> <span>'.$c->title.' </span><i class="fa fa-angle-left"></i></li>';
//                    }else{
//                        $content.='<li class="li-bg-gray" onclick="nextCats(this.id)" id="'. $c->id . '"> <span>'.$c->title.' </span><i class="fa fa-angle-left"></i></li>';
//
//                    }
//                }
//                return json_encode([
//                    'content' => $content,
//                ]);
//            } else {
//                return json_encode([
//                    'ad' => $type,
//                ]);
//            }
//        }
//    }
//
//    public
//    function prevCats($type)
//    {
//        $category_id = collect(request('categoryId'));
//        $cat = Category::where('id', Category::where('id', $category_id)->first()->id)->first();
//        if ($cat->parent_id != 0) {
//            $cat2 = $cat->category()->first();
//            $cats = $cat2->categories()->orderBy('order', 'asc')->get();
//        } else {
//            $cat2 = $cat;
//            $cats = Category::where('depth', 1)->orderBy('order', 'asc')->get();
//        }
//        $content = '';
//        if (count($cats)) {
//            if ($cat->parent_id != 0)
//                $content .= '<li class="li-bg-gray" onclick="prevCats(this.id)" id="' . $cat2->id . '"><span>بازگشت به ' . $this->repo->findCategoryById($cat2->id)->title . '</span><i class="fa fa-angle-right"></i></li>';
//            foreach ($cats as $key=>$c) {
//                if ($key%2==0)
//                {
//                    $content.='<li class="li-bg-light-gray" onclick="nextCats(this.id)" id="'. $c->id . '"> <span>'.$c->title.' </span><i class="fa fa-angle-left"></i></li>';
//
//                }else{
//                    $content.='<li class="li-bg-gray" onclick="nextCats(this.id)" id="'. $c->id . '"> <span>'.$c->title.' </span><i class="fa fa-angle-left"></i></li>';
//
//                }
//            }
//            return json_encode([
//                'content' => $content,
//            ]);
//        } else {
//            return json_encode([
//                'ad' => $type,
//            ]);
//        }
//    }

    public function checkTheSituationOfStoreAd($score, $category)
    {
//        $parentCat = $category->getGrandParent();
        $status = [];
        if (AdFee::where('category_id', $category->id)->count() == 0) {
            return $status = ['status' => 'free'];
        } else {
            $mem_ship = \auth()->user()->memberships()
                ->wherePivot('startDate', '<=', Carbon::now())
                ->wherePivot('endDate', '>', Carbon::now())
                ->first();
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


}

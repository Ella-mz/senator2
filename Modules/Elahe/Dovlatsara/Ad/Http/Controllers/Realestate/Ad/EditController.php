<?php

namespace Modules\Ad\Http\Controllers\Realestate\Ad;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Http\Requests\User\UpdateRequest;
use Modules\Ad\Repositories\AdRepository;
use Modules\AdFee\Repositories\AdFeeRepository;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Repositories\CityRepository;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\EnumType\Repositories\EnumTypeRepository;
use Modules\Map\Traits\NeshanTrait;
use Modules\Neighborhood\Repositories\NeighborhoodRepository;
use Modules\Setting\Repository\AdminSettingRepository;
use Modules\Setting\Repository\SettingRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class EditController extends Controller
{
    use GetGroupAttributeTrait, NeshanTrait;

    private $adRepository;
    private $walletRepository;
    private $settingRepository;
    private $adminSettingRepository;
    private $cityRepository;
    private $neighborhoodRepository;
    private $adFeeRepository;
    private $categoryRepository;
    private $enumTypeRepository;

    public function __construct(AdRepository $adRepository, WalletRepository $walletRepository,
                                AdminSettingRepository $adminSettingRepository, CityRepository $cityRepository,
                                NeighborhoodRepository $neighborhoodRepository, AdFeeRepository $adFeeRepository,
                                CategoryRepository $categoryRepository, SettingRepository $settingRepository,
                                EnumTypeRepository $enumTypeRepository)
    {
        $this->adRepository = $adRepository;
        $this->walletRepository = $walletRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->cityRepository = $cityRepository;
        $this->neighborhoodRepository = $neighborhoodRepository;
        $this->adFeeRepository = $adFeeRepository;
        $this->categoryRepository = $categoryRepository;
        $this->settingRepository = $settingRepository;
        $this->enumTypeRepository = $enumTypeRepository;
    }

    /**
     * @param $adId
     * @return View
     */
    public function index($adId): View
    {
        $hasSpecial = $this->adminSettingRepository->getAdminSettingByTitle('hasSpecial')->value;
        $hasScalar = $this->adminSettingRepository->getAdminSettingByTitle('hasScalar')->value;
        $hasEmergency = $this->adminSettingRepository->getAdminSettingByTitle('hasEmergency')->value;
        $ad = $this->adRepository->adFindById($adId);
        $cities = $this->cityRepository->all();
        $neighborhoods = $this->neighborhoodRepository->all();
        $attributeGroups = $this->getAttributeGroups($ad->category_id, 'supplier');
        $content = '';
        $api_key = $this->neshan_get_api_key();
        $sdk_key = $this->neshan_get_SDK_key();
        $latitude = $ad->latitude;
        $longitude = $ad->longitude;
        $mapCenter = [];
        if (isset($this->settingRepository->getSettingByTitle('latitude')->str_value) && isset($this->settingRepository->getSettingByTitle('longitude')->str_value))
            $mapCenter = [(float)$this->settingRepository->getSettingByTitle('latitude')->str_value, (float)$this->settingRepository->getSettingByTitle('longitude')->str_value];


        return view('Ads::realestate.editSinglePage', compact('ad', 'cities', 'neighborhoods', 'attributeGroups',
            'hasSpecial', 'hasEmergency', 'hasScalar', 'content', 'sdk_key', 'api_key',
            'latitude', 'longitude', 'mapCenter'));

    }

    /**
     * @param UpdateRequest $request
     * @param $adId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function update(UpdateRequest $request, $adId)
    {
        \session(['backUrl' => $request->url()]);
        $ad = $this->adRepository->adFindById($adId);
        if ($request->attribute != null) {
            foreach ($request->attribute as $key => $attribute) {
                if (!isset($attribute['alt'])) {
                    if ($this->adRepository->findAttributeById($key)->isFilterField == 1 && ($attribute['main'] == null)
                        && ($this->adRepository->findAttributeById($key)->attribute_type != 'bool')) {
                        return back()->with('message2', '??????????  ' . $this->adRepository->findAttributeById($key)->title . ' ???????????? ??????.')->withInput();
                    }
                }
            }

            foreach ($request->attribute as $key => $attribute) {
                if ($this->adRepository->findAttributeById($key)->isFilterField == 1) {
                    if (!isset($attribute['alt'])) {
                        if ($this->adRepository->findAttributeById($key)->attribute_type == 'int'
                            && (!is_numeric(str_replace(',', '', $attribute['main'])))) {
                            return back()->with('message3', '??????????  ' . $this->adRepository->findAttributeById($key)->title . ' ???????? ???? ???????? ?????? ???????? ?????? ??????.')->withInput();
                        }
                    }
                } else {
                    if (isset($attribute['main']) && $attribute['main'] != null) {
                        if ($this->adRepository->findAttributeById($key)->attribute_type == 'int' && (!is_numeric(str_replace(',', '', $attribute['main'])))) {
                            return back()->with('message3', '??????????  ' . $this->adRepository->findAttributeById($key)->title . ' ???????? ???? ???????? ?????? ???????? ?????? ??????.')->withInput();
                        }
                    }
                }
            }
        }
        if ($ad->isPaid == 'paid') {
            $ad = $this->adRepository->updateAdWithAttrsAndImages($request, $ad, auth()->user());
            \alert()->success('', '???????? ???? ???????????? ???????????? ????');
            return redirect(route('ad.index.supplier.realestate', auth()->id()));
        }
        $category = $this->categoryRepository->categoryFindById($ad->category_id);
        $adType = $request->adType ?? $ad->type;
        if ($adType == 'general')
            $submit_score = $this->enumTypeRepository->findEnumTypeByTitle('submit_general_ad_score')->link;
        elseif ($adType == 'scalar')
            $submit_score = $this->enumTypeRepository->findEnumTypeByTitle('submit_scalar_ad_score')->link;
        else
            $submit_score = $this->enumTypeRepository->findEnumTypeByTitle('submit_emergency_ad_score')->link;


        $paymentSituation = $this->checkTheSituationOfStoreAd($submit_score, $category);


        if ($paymentSituation['status'] == 'free') {
            $ad = $this->adRepository->updateAdWithAttrsAndImages($request, $ad, auth()->user());
            $ad->update([
                'paymentType' => 'free',
                'isPaid' => 'paid',
                'endDate' => Carbon::now()->add($this->adRepository->setting('duration_of_ads'), 'day'),
            ]);
        } elseif ($paymentSituation['status'] == 'membership') {
            $ad = $this->adRepository->updateAdWithAttrsAndImages($request, $ad, auth()->user());
            $ad->update([
                'paymentType' => 'membership',
                'isPaid' => 'paid',
                'endDate' => Carbon::now()->add($this->adRepository->setting('duration_of_ads'), 'day'),

            ]);
        } elseif ($paymentSituation['status'] == 'adFee') {
            $validator = Validator::make($request->all(), [
                'adPaymentFee' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $ad = $this->adRepository->updateAdWithAttrsAndImages($request, $ad, auth()->user());
            $advertisingFee = $this->adRepository->adFeeFindById($request->adPaymentFee);
            if (($ad->type == 'general' && $advertisingFee->generalAdFee != 0) ||
                ($ad->type == 'scalar' && $advertisingFee->scalarAdFee != 0) ||
                ($ad->type == 'special' && $advertisingFee->specialAdFee != 0) ||
                ($ad->type == 'emergency' && $advertisingFee->emergencyAdFee != 0)) {
                $ad->update([
                    'paymentType' => 'adFee',
                    'endDate' => Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'),
                ]);
                $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());

                return view('AdFees::realestate.payAdFee', compact('advertisingFee', 'ad', 'current_balance'));
            } else {
                $ad->update([
                    'paymentType' => 'free',
                    'isPaid' => 'paid',
                    'endDate' => Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'),
                ]);
                \alert()->success('', '???????? ???? ???????????? ???????????? ????');
                return redirect(route('ad.index.supplier.realestate', auth()->id()));
            }
        }
        \alert()->success('', '???????? ???? ???????????? ???????????? ????');
        return redirect(route('ad.index.supplier.realestate', auth()->id()));
    }

    /**
     * @param $type
     * @param $category
     * @return string[]
     */
    public function checkTheSituationOfStoreAd($score, $category)
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
        if ($this->adFeeRepository->adFeesFindByCatId($category->id)->count() == 0) {
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

    /**
     * @param $adId
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function designateOfRequestToAgencies($adId, $status): \Illuminate\Http\RedirectResponse
    {
        $ad = $this->adRepository->adFindById($adId);
        $ad->update([
            'request_to_agency' => $status,
        ]);
        return redirect()->back();
    }

    /**
     * @param $adId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function chooseReceivedAd($adId): \Illuminate\Http\RedirectResponse
    {
        $ad = $this->adRepository->adFindById($adId);
        $ad->update([
            'request_to_agency' => 'approved',
            'agency_id' => auth()->user()->hasRole('real-state-administrator') ? auth()->id() : auth()->user()->real_estate_admin_id,
        ]);
        return redirect()->back();
    }

    public function transferAd($adId, $destination)
    {
        $ad = $this->adRepository->adFindById($adId);
        if ($destination == 'toAgency')
            $ad->update([
                'agency_id' => auth()->user()->hasRole('real-state-administrator') ? auth()->id() : auth()->user()->real_estate_admin_id
            ]);
        elseif ($destination == 'quitAgency')
            $ad->update([
                'agency_id' => null
            ]);
        return redirect()->back();

    }
}

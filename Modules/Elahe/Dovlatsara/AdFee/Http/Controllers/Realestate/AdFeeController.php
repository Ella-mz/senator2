<?php

namespace Modules\AdFee\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Ad\Entities\Ad;
use Modules\AdFee\Entities\AdFee;
use Modules\AdFee\Http\Traits\AdFeeCardsTrait;
use Modules\AdminMasterNew\Http\Traits;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Category\Entities\Category;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\CostumerClub\Repositories\WalletTransactionRepository;
use Modules\Gateway\Http\Controllers\GatewayController;
use Modules\Order\Repositories\OrderRepository;
use Modules\Payment\Repositories\PaymentRepository;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Repository\AdminSettingRepository;
use RealRashid\SweetAlert\Facades\Alert;

class AdFeeController extends Controller
{
    use Traits\UploadFileTrait, AdFeeCardsTrait;

    private $gatewayController;
    private $orderRepository;
    private $paymentRepository;
    private $adminSettingRepository;
    private $gateway;
    private $saman_MID;
    private $advertisingApplication;
    private $walletRepository;
    private $walletTransactionRepository;

    public function __construct( GatewayController $gatewayController, WalletRepository $walletRepository,
                                 OrderRepository        $orderRepository, PaymentRepository $paymentRepository,
                                 AdminSettingRepository $adminSettingRepository, AdvertisingApplicationRepository $advertisingApplicationRepository,
                                 WalletTransactionRepository $walletTransactionRepository)
    {
        $this->gatewayController = $gatewayController;
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->gateway = $this->adminSettingRepository->getAdminSettingByTitle('gateway')->value;
        $this->saman_MID = $this->adminSettingRepository->getAdminSettingByTitle('saman_MID')->value;
        $this->advertisingApplication = $advertisingApplicationRepository;
        $this->walletRepository = $walletRepository;
        $this->walletTransactionRepository =$walletTransactionRepository;
    }

    public function checkTheSituationOfStoreAd($type, $category)
    {
//        $parentCat = $category->getGrandParent();
//        $status = [];
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
            return ['status' => 'free'];
        } else {
            $mem_ship = \auth()->user()->memberships()->where('package_type', $type)
                ->wherePivot('startDate', '<=', Carbon::now())
                ->wherePivot('endDate', '>', Carbon::now())
                ->first();
            if ($mem_ship) {
                if (Ad::where('user_id', \auth()->id())->where('paymentType', 'membership')
                        ->where('active', 'active')->where('advertiser', 'supplier')
                        ->where('endDate', '>=', Carbon::now())->where('isPaid', 'paid')->get()->count() >
                    DB::table('membership_user')->where('user_id', \auth()->id())
                        ->where('membership_id', $mem_ship->id)
                        ->where('startDate', '<=', Carbon::now())
                        ->where('endDate', '>', Carbon::now())->first()->number_of_allowed_ads) {
                    return ['status' => 'adFee'];

                } else {
                    return ['status' => 'membership'];
                }
            } else
                return ['status' => 'adFee'];
        }
    }

    public function checkAdFee(Request $request)
    {
        $category = Category::find($request->cat_id);

        $adFeeStat = $this->checkTheSituationOfStoreAd($request->type, $category);

//        $grandCategory_id = Category::where('id', $request->cat_id)->first()->getGrandParent();
        $adFees = $category->adFees()->get();

        if ($adFeeStat['status'] == 'adFee') {
            $content = '';
            $content .='<div class="price-box-title"><p>هزینه ثبت آگهی</p></div><div class="price-packages"><ul>';
            foreach ($adFees as $key => $adFee) {
                $content .= $this->adFeeCard($request->type, $adFee, $key);
            }
            $content .= '</ul></div>';
            return json_encode(['content' => $content]);
        } elseif ($adFeeStat['status'] == 'membership') {
            $content = '';
            $content .= $this->memshipCard();
            return json_encode(['content' => $content]);

        } elseif ($adFeeStat['status'] == 'free') {
            $content = '';
            return json_encode(['content' => $content]);

        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->wallet_value = $this->convertToEnglish(str_replace(',', '', $request->wallet_value));
        $wallet_balance = $this->walletRepository->get_wallet_balance(auth()->user());
        $adFee = AdFee::find($request->adFeeId);
        $ad = Ad::find($request->id);
        $ad->update([
            'endDate' => Carbon::now()->add($adFee->expireTimeOfAds, 'day'),
        ]);

        if (isset($request->isWallet) && is_numeric($request->wallet_value) && $request->walletValue <= $wallet_balance){
            $price = $this->price($adFee, $request->wallet_value, $ad->type);
        } else{
            $price = $this->price($adFee, 0, $ad->type);
        }

        $array = [
            'price' => $price,
            'startDate' => $ad->startDate,
            'endDate' => $ad->endDate
        ];
        $result = $this->gatewayController->index($array);
        if (!$result)
            return redirect()->route('adFee.gateway_start_error.panel');
        $order = $this->orderRepository->create($request, 'ad');
        $payment = $this->paymentRepository->create($request, $order, $result, $this->gateway, $this->saman_MID,
            'panel', \url()->route('ad.show.supplier.realestate', $ad->id));
        $this->walletTransactionRepository->deactivate_decrease_create($request->wallet_value, $order->id, auth()->user());

        return redirect()->route('start_gateway',
            [
                'merchant_code' => $result['merchant_code'],
                'resNum' => $result['resNum'],
                'gateway' => $result['gateway']
            ]);
    }

    public function price($adFee, $reduction, $type)
    {
        if ($type=='general')
            $price = $adFee->generalAdFee - $reduction;
        elseif ($type=='scalar')
            $price = $adFee->scalarAdFee - $reduction;
        elseif ($type=='special')
            $price = $adFee->specialAdFee - $reduction;
        else
            $price = $adFee->emergencyAdFee - $reduction;

        return $price;
    }

    public function adFeeListForPayment(Ad $ad)
    {
        $category = Category::find($ad->category_id);
        $adFeeStat = $this->checkTheSituationOfStoreAd($ad->type, $category);

//        $grandCategory_id = Category::where('id', $ad->category_id)->first()->getGrandParent();
        $adFees = $category->adFees()->get();
        $duration_of_ads = Setting::where('title', 'duration_of_ads')->first()->str_value;
        if ($adFeeStat['status'] == 'adFee') {
            return view('AdFees::realestate.adFeeListForPayment', compact('adFees', 'ad'));

        } elseif ($adFeeStat['status'] == 'membership') {
            $ad->update([
                'isPaid' => 'paid',
                'paymentType' => 'membership',
                'endDate' => Carbon::now()->add($duration_of_ads, 'day')
            ]);
            Alert::success('', 'با حق اشتراک شما پرداخت شد.');
            return redirect()->back();

        } elseif ($adFeeStat['status'] == 'free') {
            $ad->update([
                'isPaid' => 'paid',
                'paymentType' => 'free',
                'endDate' => Carbon::now()->add($duration_of_ads, 'day')
            ]);
            Alert::success('پرداخت شد', 'ثبت آگهی در این دسته بندی رایگان شده است.');
            return redirect()->back();
        }
    }

    public function factorPage(Request $request)
    {
        $ad = Ad::find($request->ad_id);
        $advertisingFee = AdFee::find($request->adFee_id);
        if (($ad->type == 'general' && $advertisingFee->generalAdFee != 0) || ($ad->type == 'scalar' && $advertisingFee->scalarAdFee != 0) ||
            ($ad->type == 'special' && $advertisingFee->specialAdFee != 0) || ($ad->type == 'emergency' && $advertisingFee->emergencyAdFee != 0)) {
            $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());

            return view('AdFees::realestate.payAdFee', compact('advertisingFee', 'ad', 'current_balance'));
        } else {
            $ad->update([
                'paymentType' => 'free',
                'isPaid' => 'paid',
                'endDate' => Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'),
            ]);
            Alert::success('', 'با موفقیت پرداخت شد.');
            return redirect(route('ad.index.supplier.realestate', \auth()->id()));
        }
    }

    public function startError()
    {
        return view('AdFees::realestate.startError');
    }

    public function callbackError()
    {
        return view('AdFees::realestate.callbackError');
    }

    public function showChosenAdFeeCard(Request $request)
    {
        $chosenAdFee = AdFee::find($request->adFeeId);
        $category = Category::find($request->cat_id);
        if (\auth()->check())
            $adFeeStat = $this->checkTheSituationOfStoreAd($request->type, $category);
        else
            $adFeeStat = ['status' => 'adFee'];
//        $grandCategory_id = Category::where('id', $request->cat_id)->first()->getGrandParent();
        $adFees = $category->adFees()->get();

        if ($adFeeStat['status'] == 'adFee') {
            $content = '';
//            $content .= '<div class="row">';
            $content .='<div class="price-box-title"><p>هزینه ثبت آگهی</p></div><div class="price-packages"><ul>';

            foreach ($adFees as $key => $adFee) {
                if ($chosenAdFee)
                    $content .= $this->chosenAdFeeCard($request->type, $adFee, $key, $chosenAdFee);
                else
                    $content .= $this->adFeeCard($request->type, $adFee, $key);
//                $content .= $this->chosenAdFeeCard($request->type, $adFee, $key, $chosenAdFee);
            }
            $content.='</ul></div>';
            return json_encode(['content' => $content]);
        } elseif ($adFeeStat['status'] == 'membership') {
            $content = '';
            $content .= $this->memshipCard();
            return json_encode(['content' => $content]);

        } elseif ($adFeeStat['status'] == 'free') {
            $content = '';
            return json_encode(['content' => $content]);
        }
    }

}

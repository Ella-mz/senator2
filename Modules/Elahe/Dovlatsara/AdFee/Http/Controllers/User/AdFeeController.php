<?php

namespace Modules\AdFee\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Ad\Entities\Ad;
use Modules\AdFee\Entities\AdFee;
use Modules\AdFee\Http\Traits\AdFeeCardsTrait;
use Modules\AdFee\Repositories\AdFeeRepository;
use Modules\AdminMasterNew\Http\Traits;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\CostumerClub\Repositories\WalletTransactionRepository;
use RealRashid\SweetAlert\Facades\Alert;

class AdFeeController extends Controller
{
    use Traits\UploadFileTrait, AdFeeCardsTrait;

    private $adFeeRepository;
    private $walletRepository;
    private $walletTransactionRepository;

    public function __construct(AdFeeRepository $adFeeRepository, WalletRepository $walletRepository, WalletTransactionRepository $walletTransactionRepository)
    {
        $this->adFeeRepository = $adFeeRepository;
        $this->walletRepository = $walletRepository;
        $this->walletTransactionRepository = $walletTransactionRepository;
    }

    public function checkTheSituationOfStoreAd($type, $category)
    {
        $status = [];
        if (AdFee::where('category_id', $category->id)->count() == 0) {
            return $status = ['status' => 'free'];
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
                    return $status = ['status' => 'adFee'];

                } else {
                    return $status = ['status' => 'membership'];
                }
            } else
                return $status = ['status' => 'adFee'];
        }
    }

    public function checkAdFee(Request $request)
    {
        $category = $this->adFeeRepository->categoryFindById($request->cat_id);
        $adFees = $category->adFees()->get();

        if (\auth()->check())
            $adFeeStat = $this->checkTheSituationOfStoreAd($request->type, $category);
        else {
            if ($adFees->count() > 0)
                $adFeeStat = ['status' => 'adFee'];
            else
                $adFeeStat = ['status' => 'free'];
        }

//        $grandCategory_id = Category::where('id', $request->cat_id)->first()->getGrandParent();

        if ($adFeeStat['status'] == 'adFee') {
            $content = '';
            $content .= '<div class="price-box-title"><p>هزینه ثبت آگهی</p></div><div class="price-packages"><ul>';

//            $content .= '<div class="row">';
            foreach ($adFees as $key => $adFee) {
                $content .= $this->adFeeCard($request->type, $adFee, $key);
            }
            $content .= '</ul></div>';

//            $content .= '</div>';
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

    public function price($adFee, $reduction, $type)
    {
        if ($type == 'general')
            $price = $adFee->generalAdFee - $reduction;
        elseif ($type == 'scalar')
            $price = $adFee->scalarAdFee - $reduction;
        elseif ($type == 'special')
            $price = $adFee->specialAdFee - $reduction;
        else
            $price = $adFee->emergencyAdFee - $reduction;

        return $price;
    }

    public function payTheFee(Ad $ad, $adFeeId)
    {
        $adFee = $this->adFeeRepository->adFeeFindById($adFeeId);
        $ad->update([
            'isPaid' => 'paid',
            'paymentType' => 'adFee',
            'endDate' => Carbon::now()->add($adFee->expireTimeOfAds, 'day'),
        ]);
        Alert::success('', 'با موفقیت پرداخت شد.');
        return redirect(route('ad.myPosts.supplier.user'));
    }

    public function adFeeListForPayment(Ad $ad)
    {
        $category = $this->adFeeRepository->categoryFindById($ad->category_id);
        $adFeeStat = $this->checkTheSituationOfStoreAd($ad->type, $category);

//        $grandCategory_id = Category::where('id', $ad->category_id)->first()->getGrandParent();
        $adFees = $category->adFees()->get();
        $duration_of_ads = $this->adFeeRepository->setting('duration_of_ads');
        if ($adFeeStat['status'] == 'adFee') {
            return view('AdFees::user.adFeeListForPayment', compact('adFees', 'ad'));
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
        $ad = $this->adFeeRepository->adFindById($request->ad_id);
        $advertisingFee = $this->adFeeRepository->adFeeFindById($request->adFee_id);
        if (($ad->type == 'general' && $advertisingFee->generalAdFee != 0) || ($ad->type == 'scalar' && $advertisingFee->scalarAdFee != 0) ||
            ($ad->type == 'special' && $advertisingFee->specialAdFee != 0) || ($ad->type == 'emergency' && $advertisingFee->emergencyAdFee != 0)) {
            $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());

            return view('AdFees::user.payAdFee', compact('advertisingFee', 'ad', 'current_balance'));
        } else {
            $ad->update([
                'paymentType' => 'free',
                'isPaid' => 'paid',
                'endDate' => Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'),
            ]);
            Alert::success('', 'با موفقیت پرداخت شد.');
            return redirect(route('ad.myPosts.supplier.user'));
        }
    }

    public function showChosenAdFeeCard(Request $request)
    {
        $chosenAdFee = $this->adFeeRepository->adFindById($request->adFeeId);
        $category = $this->adFeeRepository->categoryFindById($request->cat_id);
        $adFees = $category->adFees()->get();
        if (\auth()->check())
            $adFeeStat = $this->checkTheSituationOfStoreAd($request->type, $category);
        else
        {
            if($adFees->count()>0)
                $adFeeStat = ['status' => 'adFee'];
            else
                $adFeeStat = ['status' => 'free'];
        }
//        $grandCategory_id = Category::where('id', $request->cat_id)->first()->getGrandParent();

        if ($adFeeStat['status'] == 'adFee') {
            $content = '';
            $content .= '<div class="price-box-title"><p>هزینه ثبت آگهی</p></div><div class="price-packages"><ul>';
//            $content .= '<div class="row">';
            foreach ($adFees as $key => $adFee) {
                if ($chosenAdFee)
                    $content .= $this->chosenAdFeeCard($request->type, $adFee, $key, $chosenAdFee);
                else
                    $content .= $this->adFeeCard($request->type, $adFee, $key);
            }
            $content .= '</ul></div>';
//            $content .= '</div>';
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

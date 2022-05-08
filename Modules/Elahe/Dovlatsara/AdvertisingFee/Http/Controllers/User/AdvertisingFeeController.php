<?php

namespace Modules\AdvertisingFee\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\AdvertisingFee\Entities\AdvertisingFee;
use Modules\AdvertisingFee\Http\Requests\Admin\StoreRequest;
use Modules\AdvertisingFee\Http\Requests\Admin\UpdateRequest;
use Modules\AdvertisingFee\Http\Traits\AdFeeCardsTrait;
use Modules\Category\Entities\Category;
use Modules\GroupAttribute\Entities\GroupAttribute;
use RealRashid\SweetAlert\Facades\Alert;

class AdvertisingFeeController extends Controller
{
    use AdFeeCardsTrait;

//    public function checkTheSituationOfStoreAd($type, $category)
//    {
//        $parentCat = $category->getGrandParent();
//        $status = [];
////        if ($request['advertiser']==1){
////            if (Setting::first()->isFreeSupplierSubmit == 0) {
////                return $status=['status'=>'free'];
////            }
////        }else{
////            if (Setting::first()->isFreeApplicantSubmit == 0) {
////                return $status=['status'=>'free'];
////            }
////        }
//        if (AdvertisingFee::where('category_id', $parentCat)->count() == 0) {
//            return $status = ['status' => 'free'];
//        } else {
//            $mem_ship = Auth::user()->memberships()->where('package_type', $type)
//                ->wherePivot('startDate', '<=', Carbon::now())
//                ->wherePivot('endDate', '>', Carbon::now())
//                ->first();
////            return $mem_ship;
//            if ($mem_ship) {
//                if (Ad::where('user_id', Auth::id())->where('paymentType', 'membership')
//                        ->where('active', 'active')->where('advertiser', 'supplier')
//                        ->where('endDate', '>=', Carbon::now())->where('isPaid', 'paid')->get()->count() >
//                    DB::table('membership_user')->where('user_id', Auth::id())
//                        ->where('membership_id', $mem_ship->id)
//                        ->where('startDate', '<=', Carbon::now())
//                        ->where('endDate', '>', Carbon::now())->first()->number_of_allowed_ads) {
//                    return $status = ['status' => 'adFee'];
//
//                } else {
//                    return $status = ['status' => 'membership'];
//                }
//            } else
//                return $status = ['status' => 'adFee'];
//        }
//    }
//
//    public function checkAdFee(Request $request)
//    {
//        $category = Category::find($request->cat_id);
//
//        $adFeeStat = $this->checkTheSituationOfStoreAd($request->type, $category);
////        return json_encode(['content' => $adFeeStat]);
//
//        $grandCategory_id = Category::where('id', $request->cat_id)->first()->getGrandParent();
//        $adFees = Category::where('id', $grandCategory_id)->first()->adFees()->get();
//
//        if ($adFeeStat['status'] == 'adFee') {
//            $content = '';
//            $content .= '<div class="row">';
//            foreach ($adFees as $adFee) {
//                $content.=$this->adFeeCard($request->type, $adFee);
//            }
//            $content .= '</div>';
//            return json_encode(['content' => $content]);
////            $this->adFeeCard($request->type, );
//        } elseif ($adFeeStat['status'] == 'membership') {
//            $content = '';
//            $content.=$this->memshipCard();
//            return json_encode(['content' => $content]);
//
//        } elseif ($adFeeStat['status'] == 'free') {
//            $content = '';
//            return json_encode(['content' => $content]);
//
//        }
////        $content = $this->memshipCard(1, $mem_user);
////        return json_encode(['content' => $content]);
//
//    }
//
//    public function payTheFee(Ad $ad)
//    {
//        $startDate=new \DateTime($ad->startDate);
//        $endDate=new \DateTime($ad->endDate);
//        $interval =$startDate->diff($endDate)->days;
//        $ad->update([
//            'isPaid' => 'paid',
////            'paymentType'=>'adFee',
//            'endDate'=>Carbon::now()->add($interval, 'day'),
//        ]);
//        Alert::success('', 'با موفقیت پرداخت شد.');
////        Alert::success('با تشکر', 'هزینه آگهی شما پرداخت شد و آگهی ثبت شد.');
//        return redirect(route('homePage.user'));
//    }
}

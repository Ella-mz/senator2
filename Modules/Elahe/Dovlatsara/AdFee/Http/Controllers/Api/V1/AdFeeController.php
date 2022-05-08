<?php

namespace Modules\AdFee\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\AdFee\Entities\AdFee;
use Modules\AdFee\Http\Traits\AdFeeCardsTrait;
use Modules\AdFee\Repositories\AdFeeRepository;
use Modules\AdFee\Transformers\AdFeeCollection;
use Modules\AdFee\Transformers\AdFeeWithTypeOfAdCollection;
use Modules\AdminMasterNew\Http\Traits;

class AdFeeController extends Controller
{
    use Traits\UploadFileTrait, AdFeeCardsTrait;

    public $repo;

    public function __construct(AdFeeRepository $adFeeRepository)
    {
        $this->repo = $adFeeRepository;
    }

    public function checkTheSituationOfStoreAd($type, $category, $user)
    {
        $status = [];
        if (!$user){
            if (AdFee::where('category_id', $category->id)->count() == 0)
                return $status = ['status' => 'free'];
            else
                return $status = ['status' => 'adFee'];
        }
        if (AdFee::where('category_id', $category->id)->count() == 0) {
            return $status = ['status' => 'free'];
        } else {
            $mem_ship = $user->memberships()->where('package_type', $type)
                ->wherePivot('startDate', '<=', Carbon::now())
                ->wherePivot('endDate', '>', Carbon::now())
                ->first();
            if ($mem_ship) {
                if (Ad::where('user_id', $user->id)->where('paymentType', 'membership')
                        ->where('active', 'active')->where('advertiser', 'supplier')
                        ->where('endDate', '>=', Carbon::now())->where('isPaid', 'paid')->get()->count() >
                    DB::table('membership_user')->where('user_id', $user->id)
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
////        $parentCat = $category->getGrandParent();
//        $status = [];
//        if (AdFee::where('category_id', $category->id)->count() == 0) {
//            return $status = ['status' => 'free'];
//        } else {
//            $mem_ship = $user->memberships()->where('package_type', $type)
//                ->wherePivot('startDate', '<=', Carbon::now())
//                ->wherePivot('endDate', '>', Carbon::now())
//                ->first();
////            return $mem_ship;
//            if ($mem_ship) {
//                if (Ad::where('user_id', $user->id)->where('paymentType', 'membership')
//                        ->where('active', 'active')->where('advertiser', 'supplier')
//                        ->where('endDate', '>=', Carbon::now())->where('isPaid', 'paid')->get()->count() >
//                    DB::table('membership_user')->where('user_id', $user->id)
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
    }

    public function checkAdFee(Request $request)
    {
//        $headerValidator = Validator::make($request->header(), [
//            'authorization' => 'required',
//        ]);
//        if ($headerValidator->fails()) {
//            return response()->json([
//                'data' => [],
//                'errors' => $headerValidator->errors()->all(),
//                'status_code' => 401
//            ], 401);
//        }
        $validator = Validator::make($request->all(), [
            'categoryId' => 'required',
            'type'=> 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status' => 403
            ], Response::HTTP_FORBIDDEN);
        }
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        $category = $this->repo->categoryFindById($request->categoryId);
        if (!$category)
            return response()->json([
                'status_code' => 403,
                'errors' => ['category Id is invalid'],
            ], Response::HTTP_FORBIDDEN);

        $adFeeStat = $this->checkTheSituationOfStoreAd($request->type, $category, $user);
//        return json_encode(['content' => $adFeeStat]);

//        $grandCategory_id = $category->getGrandParent();
        $adFees = $category->adFees()->get();

        if ($adFeeStat['status'] == 'adFee') {
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => 'adFee',
                    'adFees' => (new AdFeeWithTypeOfAdCollection($adFees))->type($request->type),
                ],
            ], Response::HTTP_OK);
        } elseif ($adFeeStat['status'] == 'membership') {
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => 'membership',
                    'adFees' => [],
                ],
            ], Response::HTTP_OK);

        } elseif ($adFeeStat['status'] == 'free') {
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => 'free',
                    'adFees' => [],
                ],
            ], Response::HTTP_OK);
        }
    }

    public function payTheFee($adId, $adFeeId)
    {
        $ad = $this->repo->adFindById($adId);
        $adFee= $this->repo->adFeeFindById($adFeeId);
        $ad->update([
            'isPaid' => 'paid',
            'paymentType'=>'adFee',
            'endDate' => Carbon::now()->add($adFee->expireTimeOfAds, 'day'),
        ]);
        return response()->json([
            'status_code' => 200,
            'data' => 'با موفقیت پرداخت شد',
        ], Response::HTTP_OK);
    }

    public function adFeeListForPayment(Request $request, $adId)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $headerValidator->errors()->all(),
                'status_code' => 401
            ], 401);
        }
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        $ad = $this->repo->adFindById($adId);
        $category = $this->repo->categoryFindById($ad->category_id);
        if (!$category)
            return response()->json([
                'status_code' => 403,
                'errors' => ['category Id is invalid'],
            ], Response::HTTP_FORBIDDEN);

        $adFeeStat = $this->checkTheSituationOfStoreAd($ad->type, $category, $user);

//        $grandCategory_id = $category->getGrandParent();
        $adFees = $category->adFees()->get();
        $duration_of_ads = $this->repo->setting('duration_of_ads');
        if ($adFeeStat['status'] == 'adFee') {
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => 'adFee',
                    'ad_id' => $ad->id,
                    'adFees' => (new AdFeeWithTypeOfAdCollection($adFees))->type($ad->type),
                ],
            ], Response::HTTP_OK);

        } elseif ($adFeeStat['status'] == 'membership') {
            $ad->update([
               'isPaid'=>'paid',
                'paymentType'=>'membership',
                'endDate'=>Carbon::now()->add($duration_of_ads, 'day')
            ]);
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => 'membership',
                    'ad_id' => $ad->id,
                    'adFees' => [],
                ],
            ], Response::HTTP_OK);

        } elseif ($adFeeStat['status'] == 'free') {
            $ad->update([
                'isPaid'=>'paid',
                'paymentType'=>'free',
                'endDate'=>Carbon::now()->add($duration_of_ads, 'day')
            ]);
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => 'free',
                    'ad_id' => $ad->id,
                    'adFees' => [],
                ],
            ], Response::HTTP_OK);

        }
    }

    public function factorPage(Request $request)
    {
//        $ad = Ad::find($request->ad_id);
//        $advertisingFee = AdFee::find($request->adFee_id);
//        return view('AdFees::user.payAdFee', compact('advertisingFee', 'ad'));
    }
}

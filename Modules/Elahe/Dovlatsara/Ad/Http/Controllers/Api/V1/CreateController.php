<?php

namespace Modules\Ad\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Traits\StoreSupplierAdTrait;
use Modules\Ad\Repositories\AdRepository;
use Modules\AdFee\Entities\AdFee;
use Modules\Attribute\Entities\Attribute;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\GroupAttribute\Transformers\GroupAttributeForCreateCollection;
use Modules\Setting\Repository\AdminSettingRepository;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Entities\User;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class CreateController extends Controller
{
    use GetGroupAttributeTrait, StoreSupplierAdTrait;

    public $repo;
    private $adminSettingRepository;
    private $settingRepository;
    private $walletRepository;

    public function __construct(AdRepository $adRepository, AdminSettingRepository $adminSettingRepository,
                                SettingRepository $settingRepository, WalletRepository $walletRepository)
    {
        $this->repo = $adRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->settingRepository = $settingRepository;
        $this->walletRepository = $walletRepository;
    }

    /**
     * @param Request $request
     * @param $categoryId
     * @return JsonResponse
     */

    public function createSupplier(Request $request, $categoryId)
    {
//        $headerValidator = Validator::make($request->header(), [
//            'authorization' => 'required',
//        ]);
//        if ($headerValidator->fails()) {
//            return response()->json([
//                'data' => [],
//                'errors' => $headerValidator->errors()->all(),
//                'status' => 401
//            ], 401);
//        }
//        $user = User::where('api_token', $request->header('authorization'))->first();
//        if (!$user)
//            return response()->json([
//                'status_code' => 404,
//                'errors' => ['token is invalid'],
//            ], Response::HTTP_NOT_FOUND);
        $category = $this->repo->findCategoryById($categoryId);
        if(!$category || $category->node==0)
            return response()->json([
                'status_code' => 403,
                'errors' => ['category is not allowed'],
            ], Response::HTTP_FORBIDDEN);
        $attributeGroups = $this->getAttributeGroups($category->id, 'supplier');
        $attributeGroups = $attributeGroups->whereIn('advertiser', ['supplier', 'both'])->pluck('id')->toArray();
        $attributeGroups = $this->repo->attributeGroupsById($attributeGroups);

        if ($this->repo->adminSetting('hasScalar') == 1) $isScalar = 1; else $isScalar = 0;
        if ($this->repo->adminSetting('hasSpecial') == 1) $isSpecial = 1; else $isSpecial = 0;
        if ($this->repo->adminSetting('hasEmergency') == 1) $isEmergency = 1; else $isEmergency = 0;

        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => new GroupAttributeForCreateCollection($attributeGroups),
                'adType' => [
                    ['title' => 'عادی', 'value' => 'general', 'isActive' => 1],
                    ['title' => 'نردبانی', 'value' => 'scalar', 'isActive' => $isScalar],
                    ['title' => 'ویژه', 'value' => 'special', 'isActive' => $isSpecial],
                    ['title' => 'فوری', 'value' => 'emergency', 'isActive' => $isEmergency]
                ],
            ],
        ], Response::HTTP_OK);

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeSupplier(Request $request)
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
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'city' => 'required',
            'adType' => 'required',
            'categoryId'=> 'required',
            'address' => 'required',
//            'adImage.1' => 'max:128',
//            'adImage.2' => 'max:128',
//            'adImage.3' => 'max:128',
//            'adImage.4' => 'max:128',
//            'adImage.5' => 'max:128',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status_code' => 403
            ], Response::HTTP_FORBIDDEN);
        }
        $errors = [];
        $errors2 = [];

        if ($request->attribute != null) {
            foreach (json_decode($request->attribute, true) as $key => $attribute) {
                if (Attribute::where('id', $attribute['id'])->first()->isFilterField == 1 && ($attribute['value'] == null) &&
                    (Attribute::where('id', $attribute['id'])->first()->attribute_type != 'bool')) {
                    array_push($errors, 'مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' الزامی است.');

                }
            }
            if (count($errors) > 0)
                return response()->json([
                    'data' => '',
                    'errors' => $errors,
                    'status_code' => 403
                ], 403);

            foreach (json_decode($request->attribute, true) as $key => $attribute) {
                if (Attribute::where('id', $attribute['id'])->first()->isFilterField == 1) {
                    if (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'int' && (!is_numeric(str_replace(',', '', $attribute['value'])))) {
                     array_push($errors2, 'مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' باید به صورت عدد وارد شود است.');
//                        return response()->json([
//                            'data' => '',
//                            'errors' => ['مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' باید به صورت عدد وارد شود است.'],
//                            'status_code' => 403
//                        ], 403);
                    }
                } else {
                    if ($attribute['value'] != null) {
                        if (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'int' &&
                            (!is_numeric(str_replace(',', '', $attribute['value'])))) {
                            array_push($errors2, 'مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' باید به صورت عدد وارد شود است.');
//                            return response()->json([
//                                'data' => '',
//                                'errors' => ['مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' باید به صورت عدد وارد شود است.'],
//                                'status_code' => 403
//                            ], 403);
                        }
                    }
                }
            }
            if (count($errors2) > 0)
                return response()->json([
                    'data' => '',
                    'errors' => $errors2,
                    'status_code' => 403
                ], 403);
        }

        $user = User::where('api_token', $request->header('authorization'))->first();
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);

        $category = $this->repo->findCategoryById($request->categoryId);
        if (!$category)
            return response()->json([
                'status_code' => 403,
                'errors' => ['category Id is invalid'],
            ], Response::HTTP_FORBIDDEN);

        $paymentSituation = $this->checkTheSituationOfStoreAd($request->adType, $category, $user);

        if ($paymentSituation['status'] == 'free') {
            $ad = $this->storeAdWithAttrsAndImagesApi($request, $user);
            $ad->update([
                'paymentType' => 'free',
                'isPaid' => 'paid',
                'endDate' => Carbon::now()->add($this->repo->setting('duration_of_ads'), 'day'),

            ]);
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => 'آگهی با موفقیت ثبت شد',
                    'ad_id' => $ad->id,
                    'adFee' => '',
                ],
            ], Response::HTTP_OK);
        } elseif ($paymentSituation['status'] == 'membership') {
            $ad = $this->storeAdWithAttrsAndImagesApi($request, $user);
            $ad->update([
                'paymentType' => 'membership',
                'isPaid' => 'paid',
                'endDate' => Carbon::now()->add($this->repo->setting('duration_of_ads'), 'day'),

            ]);
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => 'آگهی با موفقیت ثبت شد',
                    'ad_id' => $ad->id,
                    'adFee' => '',
                ],
            ], Response::HTTP_OK);
        } elseif ($paymentSituation['status'] == 'adFee') {
            $validator = Validator::make($request->all(), [
                'adPaymentFee' => 'required',

            ]);
            if ($validator->fails()) {
                return response()->json([
                    'data' => [],
                    'errors' => $validator->errors()->all(),
                    'status' => 403
                ], Response::HTTP_FORBIDDEN);
            }
            $ad = $this->storeAdWithAttrsAndImagesApi($request, $user);

            $advertisingFee = $this->repo->adFeeFindById($request->adPaymentFee);
            if (($ad->type == 'general' && $advertisingFee->generalAdFee != 0) || ($ad->type == 'scalar' && $advertisingFee->scalarAdFee != 0) ||
                ($ad->type == 'special' && $advertisingFee->specialAdFee != 0) || ($ad->type == 'emergency' && $advertisingFee->emergencyAdFee != 0)) {
                $ad->update([
                    'paymentType' => 'adFee',
                    'endDate' => Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'),
                ]);
            }else{
                $ad->update([
                    'paymentType' => 'free',
                    'isPaid' => 'paid',
                    'endDate' => Carbon::now()->add($advertisingFee->expireTimeOfAds, 'day'),
                ]);
                return response()->json([
                    'status_code' => 200,
                    'data' => [
                        'data' => 'آگهی با موفقیت ثبت شد',
                        'ad_id' => $ad->id,
                        'adFee' => '',
                    ],
                ], Response::HTTP_OK);
            }
           $adFee= $this->adFee($ad, $advertisingFee);
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data'=>'آگهی با موفقیت ثبت شد',
                    'ad_id' => $ad->id,
                    'adFee' => $adFee,
                ],

            ], Response::HTTP_OK);
        }
    }

    public function adFee($ad, $advertisingFee)
    {
        if ($ad->type == 'general')
            $adFee = $advertisingFee->generalAdFee;
        elseif ($ad->type == 'scalar')
            $adFee = $advertisingFee->scalarAdFee;
        elseif ($ad->type == 'special')
            $adFee = $advertisingFee->specialAdFee;
        elseif ($ad->type == 'emergency')
            $adFee = $advertisingFee->emergencyAdFee;
        else
            $adFee='';
        return $adFee;
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
    }


}

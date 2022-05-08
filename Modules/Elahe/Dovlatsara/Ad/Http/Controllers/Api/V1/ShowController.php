<?php

namespace Modules\Ad\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdCollection;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\Advertising\Transformers\AdvertisingApplicationShowCollection;
use Modules\Recentseen\Entities\Recentseen;
use Modules\User\Entities\User;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class ShowController extends Controller
{
    use GetGroupAttributeTrait;

    private $advertisingRepository;
    private $advertisingApplicationRepository;

    public function __construct(AdvertisingRepository $advertisingRepository,
                                AdvertisingApplicationRepository $advertisingApplicationRepository)
    {
        $this->advertisingRepository = $advertisingRepository;
        $this->advertisingApplicationRepository = $advertisingApplicationRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function myAds(Request $request): JsonResponse
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
        $user = User::where('api_token', $request->header('authorization'))->first();
        if ($user) {
            $ads = Ad::where('user_id', $user->id)->where('advertiser', 'supplier')->orderByDesc('created_at')->paginate(8);
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => new AdCollection($ads),
                    'total' => $ads->total(),
                    'path' => $ads->path(),
                    'perPage' => $ads->perPage(),
                    'currentPage' => $ads->currentPage(),
                    'lastPage' => $ads->lastPage(),
                ],

            ], Response::HTTP_OK);
        } else
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
    }

    public function show(Request $request, Ad $ad)
    {
        try {
            $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('AdDetailPage');
            $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
            $user = User::where('api_token', $request->header('authorization'))->first();
            if ($user) {
                if ($user->id!=$ad->user_id){
                    $x = $ad->viewCount + 1;
                    $ad->update(['viewCount' => $x,]);
                }
                if (Recentseen::where('ad_id', $ad->id)->where('user_id', $user->id)->first() == null)
                    Recentseen::create([
                        'user_id' => $user->id,
                        'ad_id' => $ad->id,
                    ]);
            }else{
                $x = $ad->viewCount + 1;
                $ad->update(['viewCount' => $x,]);
            }
            if ($ad) {
                return response()->json([
                    'status_code' => 200,
                    'data' => new \Modules\Ad\Transformers\Ad($ad),
                    'advertisement' => new AdvertisingApplicationShowCollection($advertisement)

                ], Response::HTTP_OK);
            } else
                return response()->json([
                    'status_code' => 404,
                    'errors' => ['Ad Id is invalid'],
                ], Response::HTTP_NOT_FOUND);
        }catch (Exception $e){
            return response()->json([
                'status_code' => 403,
                'errors' => [],
            ], Response::HTTP_FORBIDDEN);
        }
    }

    public function similarAds(Ad $ad)
    {
        try {

            $ads = Ad::with('attributes:id,title,unit,min,max,isSignificant,attribute_type')
                ->where('active', 'active')
                ->where('endDate', '>', Carbon::now())
                ->where('advertiser', 'supplier')
                ->where('userStatus', 'active')
                ->where('isPaid', 'paid')
                ->where('city_id', $ad->city_id)
                ->where('category_id', $ad->category_id)
                ->where('id', '!=', $ad->id)
                ->orderByDesc('created_at')->paginate(10);
            return response()->json([
                'status_code' => 200,
                'data' =>[
                    'data' => new AdCollection($ads),
                    'total' => $ads->total(),
//                'next_page_url' => $contractors->next_page_url(),
                    'path' => $ads->path(),
                    'perPage' => $ads->perPage(),
                    'currentPage' => $ads->currentPage(),
                    'lastPage' => $ads->lastPage(),
                ],
            ], Response::HTTP_OK);
        }catch (Exception $e){
            return response()->json([
                'status_code' => 403,
                'errors' => [],
            ], Response::HTTP_FORBIDDEN);
        }
    }
}

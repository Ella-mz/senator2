<?php

namespace Modules\Recentseen\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdCollection;
use Modules\Bookmark\Entities\Bookmark;
use Modules\Recentseen\Entities\Recentseen;
use Modules\User\Entities\User;

class RecentseenController extends Controller
{
//    public function bookmarked(Request  $request)
//    {
//        $ad = Ad::where('id', $request->id)->first();
//        $favorite1 = Bookmark::where('ad_id', $ad->id)->where('user_id', auth()->id())->first();
//        if ($favorite1) {
//            if ($request->favorite == 1) {
//                $favorite1->update([
//                    'status' => 0,
//                    'updated_user' => auth()->id()
//                ]);
//            } elseif ($request->favorite == 0) {
//                $favorite1->update([
//                    'status' => 1,
//                    'updated_user' => auth()->id()
//                ]);
//            }
//        } else {
//            if ($request->favorite == 1) {
//
//                Bookmark::create([
//                    'ad_id' => $ad->id,
//                    'user_id' => auth()->id(),
//                    'status' => 0,
//                    'created_user' => auth()->id()
//                ]);
//            } elseif ($request->favorite == 0) {
//                Bookmark::create([
//                    'ad_id' => $ad->id,
//                    'user_id' => auth()->id(),
//                    'status' => 1,
//                    'created_user' => auth()->id()
//                ]);
//            }
//        }
//
//        return response()->json([
//            'data' => 'بوک مارک شد',
//            'status' => 200
//        ]);
//    }

    public function recentseen(Request $request)
    {
        try {
            $headerValidator = Validator::make($request->header(), [
                'authorization' => 'required',
            ]);
            if ($headerValidator->fails()) {
                return response()->json([
                    'data' => $request->header(),
                    'errors' => $headerValidator->errors()->all(),
                    'status_code' => 401,
                ], 401);
            }
            $user = User::where('api_token', $request->header('authorization'))->first();
            if ($user) {
                $ad_ids = Recentseen::where('user_id', $user->id)->pluck('ad_id')->toArray();
                $ads = Ad::whereIn('id', $ad_ids)->paginate(8);
                return response()->json([
                    'status_code' => 200,
                    'data' => [
                        'data'=>new AdCollection($ads),
                        'total' => $ads->total(),
                        'path' => $ads->path(),
                        'perPage' => $ads->perPage(),
                        'currentPage' => $ads->currentPage(),
                        'lastPage' => $ads->lastPage(),
                        ],

                ], Response::HTTP_OK);
            }else
                return response()->json([
                    'status_code' => 404,
                    'errors' => ['token is invalid'],
                ], Response::HTTP_NOT_FOUND);
        }catch (\Exception $e){
            return response()->json([
                'status_code' => 403,
                'errors' => [],
            ], Response::HTTP_FORBIDDEN);
        }
    }
}

<?php

namespace Modules\Bookmark\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdCollection;
use Modules\Bookmark\Entities\Bookmark;
use Modules\User\Entities\User;

class BookmarkController extends Controller
{
    public function bookmarked(Request $request)
    {
        try {
            $headerValidator = Validator::make($request->header(), [
                'authorization' => 'required',
            ]);
            if ($headerValidator->fails()) {
                return response()->json([
                    'data' => '',
                    'errors' => $headerValidator->errors()->all(),
                    'status_code' => 401,
                ], 401);
            }
            $validator = Validator::make($request->all(), [
                'ad_id' => 'required',
                'bookmark'=>'required'
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'data' => '',
                    'errors' => $validator->errors()->all(),
                    'status_code' => 403,
                ], 403);
            }
            $user = User::where('api_token', $request->header('authorization'))->first();
            if ($user) {
                $ad = Ad::where('id', $request->ad_id)->first();
                $favorite1 = Bookmark::where('ad_id', $ad->id)->where('user_id', $user->id)->first();
                if ($favorite1) {
                    if ($request->bookmark == 1) {
                        $favorite1->update([
                            'status' => 1,
                            'updated_user' => $user->id
                        ]);
                    } elseif ($request->bookmark == 0) {
                        $favorite1->update([
                            'status' => 0,
                            'updated_user' => $user->id
                        ]);
                    }
                } else {
                    if ($request->bookmark == 1) {
                        Bookmark::create([
                            'ad_id' => $ad->id,
                            'user_id' => $user->id,
                            'status' => 1,
                            'created_user' => $user->id
                        ]);
                    } elseif ($request->bookmark == 0) {
                        Bookmark::create([
                            'ad_id' => $ad->id,
                            'user_id' => $user->id,
                            'status' => 0,
                            'created_user' => $user->id
                        ]);
                    }
                }

                return response()->json([
                    'data' => 'بوک مارک شد',
                    'status' => 200
                ]);
            }else
                return response()->json([
                    'status_code' => 404,
                    'errors' => ['token is invalid'],
                ], Response::HTTP_NOT_FOUND);

        } catch (\Exception $e) {

        }
    }

    public function bookmarks(Request $request)
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
                $ad_ids = Bookmark::where('user_id', $user->id)->where('status', 1)->pluck('ad_id')->toArray();
                $ads = Ad::whereIn('id', $ad_ids)->paginate(8);
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
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 403,
                'errors' => [],
            ], Response::HTTP_FORBIDDEN);
        }
    }
}

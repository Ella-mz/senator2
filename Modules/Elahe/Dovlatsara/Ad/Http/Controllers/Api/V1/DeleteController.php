<?php

namespace Modules\Ad\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Repositories\AdRepository;
use Modules\GroupAttribute\Transformers\GroupAttributeForCreateCollection;
use Modules\User\Entities\User;
use RealRashid\SweetAlert\Facades\Alert;

class DeleteController extends Controller
{
    private $repo;

    public function __construct(AdRepository $adRepository)
    {
        $this->repo = $adRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $adId)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $headerValidator->errors()->all(),
                'status' => 401
            ], 401);
        }
        $ad = $this->repo->adFindById($adId);

        $user = User::where('api_token', $request->header('authorization'))->first();
        if (!$user || $user->id != $ad->user_id)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        if (!$ad)
            return response()->json([
                'status_code' => 404,
                'data' => [],
                'errors' => ['ad id is invalid']
            ], Response::HTTP_NOT_FOUND);
        $ad->update([
            'active' => 'delete'
        ]);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => 'successfully deleted',
            ],
        ], Response::HTTP_OK);

    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active(Request $request, $adId)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $headerValidator->errors()->all(),
                'status' => 401
            ], 401);
        }
        $ad = $this->repo->adFindById($adId);

        $user = User::where('api_token', $request->header('authorization'))->first();
        if (!$user || $user->id != $ad->user_id)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        if (!$ad)
            return response()->json([
                'status_code' => 404,
                'data' => [],
                'errors' => ['ad id is invalid']
            ], Response::HTTP_NOT_FOUND);
        $ad->update([
            'userStatus' => 'active'
        ]);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => 'successfully activated',
            ],
        ], Response::HTTP_OK);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function inactive(Request $request, $adId)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $headerValidator->errors()->all(),
                'status' => 401
            ], 401);
        }
        $ad = $this->repo->adFindById($adId);

        $user = User::where('api_token', $request->header('authorization'))->first();
        if (!$user || $user->id != $ad->user_id)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        if (!$ad)
            return response()->json([
                'status_code' => 404,
                'data' => [],
                'errors' => ['ad id is invalid']
            ], Response::HTTP_NOT_FOUND);
        $ad->update([
            'userStatus' => 'inactive'
        ]);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => 'successfully inactivated',
            ],
        ], Response::HTTP_OK);
    }
}

<?php

namespace Modules\User\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\User\Repositories\UserRepository;
use Modules\User\Transformers\User;

class UserController extends Controller
{

    private $repo;

    public function __construct(UserRepository $userRepository)
    {
        $this->repo = $userRepository;
    }

    public function profile(Request $request)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $headerValidator->errors()->all(),
                'status_code' => 401
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'data' => [],
                'errors' => ['کاربر یافت نشد'],
                'status_code' => 404
            ], Response::HTTP_NOT_FOUND);

        return response()->json([
            'status_code' => 200,
            'data' => new User($user),
        ], Response::HTTP_OK);

    }
}

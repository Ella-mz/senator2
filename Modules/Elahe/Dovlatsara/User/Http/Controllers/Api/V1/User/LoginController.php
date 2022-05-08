<?php

namespace Modules\User\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\User\Http\Requests\Authentication\User\LoginRequest;
use Modules\User\Repositories\UserRepository;

class LoginController extends Controller
{
    private $repo;

    public function __construct(UserRepository $userRepository)
    {
        $this->repo=$userRepository;
    }


    public function login(LoginRequest $request)
    {
        $users = $this->repo->usersGetByMobile($request->mobile);
        $login_user = null;
        foreach ($users as $user){
            if ($user->hasRole('ordinary-user'))
                $login_user = $user;
        }
        if ($login_user) {
            //sms
            $code = mt_rand(1000, 9999);
//            $code = 1234;

            app('Modules\SMS\Http\Controllers\SMSController')
                ->send_sms_with_pattern($user->mobile, null, $code,53372,$user, 'VerificationCode');
            DB::table('verification')->insert([
                'mobile' => $request->mobile,
                'code' => $code,
                'created_at' => Carbon::now(),
            ]);
            return response()->json([
                'status_code' => 200,
                'data' => 'verification code sent',
            ], Response::HTTP_OK);

        } else {
            return response()->json([
                'status_code' => 404,
                'errors' => ['user did not registered'],
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function verify(Request $request)
    {
        $users = $this->repo->usersGetByMobile($request->mobile);
        $login_user = null;
        foreach ($users as $user){
            if ($user->hasRole('ordinary-user'))
                $login_user = $user;
        }
        if ($login_user) {
            $verfication = DB::table('verification')
                ->where('mobile', $request->mobile)
                ->orderByDesc('created_at')->first();

            if ($verfication->code == $request->verification_code) {
                $token = $login_user->generateToken();

                return response()->json([
                    'status_code' => 200,
                    'data' => $token,
                ], Response::HTTP_OK);

            } else {
                return response()->json([
                    'status_code' => 403,
                    'errors' => ['verification code is not correct'],
                ], Response::HTTP_FORBIDDEN);
            }
        }else{
            return response()->json([
                'status_code' => 404,
                'errors' => ['user did not registered'],
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function logout(Request $request)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => '',
                'errors' => $headerValidator->errors()->all(),
                'status_code' => 401
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'data' => '',
                'errors' => ['کاربر یافت نشد'],
                'status_code' => 404
            ], Response::HTTP_NOT_FOUND);
        $user->update([
            'api_token'=>null,
        ]);
        return response()->json([
            'status_code' => 200,
            'data' => 'کاربر با موفقیت خروج کرد:))',
        ], Response::HTTP_OK);
    }
}

<?php

namespace Modules\User\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\RoleAndPermission\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;

class RegisterController extends Controller
{
    private $repo;

    public function __construct(UserRepository $userRepository)
    {
        $this->repo=$userRepository;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sirName' => 'required',
            'mobile' => [
                'required', 'iran_mobile',
                Rule::unique('users', 'mobile')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'userName' => [
                'required', 'max:255',
                Rule::unique('users', 'userName')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })
            ],
            'password' => 'required',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status_code' => 403,
            ], Response::HTTP_FORBIDDEN);
        }
        $users = $this->repo->usersGetByMobile($request->mobile);
        $reg_user = null;
        foreach ($users as $user){
            if ($user->hasRole('ordinary-user'))
                $reg_user = $user;
        }
        if ($reg_user)
            return response()->json([
                'data' => [],
                'errors' => ['کاربر با این شماره موبایل قبلا در سیستم ثبت نام کرده است.'],
                'status_code' => 403,
            ], Response::HTTP_FORBIDDEN);
        if ($this->convertToEnglish($request->password== $this->convertToEnglish($request->confirm_password))) {
            $user = User::create([
                'name' => $request->name,
                'sirName' => $request->sirName,
                'email' => $this->convertToEnglish($request->email),
                'mobile' => $this->convertToEnglish($request->mobile),
                'password' => bcrypt($this->convertToEnglish($request->password)),
                'userName'=>$request->userName,

            ]);
            $uniqueCode = $user->id + 10000;
            $user->update(['user_id' => $uniqueCode]);
            $user->roles()->sync(Role::where('slug', 'ordinary-user')
                ->first()->id);

            $code = mt_rand(1000, 9999);
//            $code = 1234;
            DB::table('verification')->insert([
                'mobile' => $request->mobile,
                'code' => $code,
                'created_at' => Carbon::now(),
            ]);
            //sms
            app('Modules\SMS\Http\Controllers\SMSController')
                ->send_sms_with_pattern($user->mobile, null, $code, 45633, $user, 'VerificationCode');

            return response()->json([
                'status_code' => 200,
                'data' => 'verification code sent',
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                'status_code' => 403,
                'errors' => ['passwords do not match'],
            ], Response::HTTP_FORBIDDEN);
        }
    }

}

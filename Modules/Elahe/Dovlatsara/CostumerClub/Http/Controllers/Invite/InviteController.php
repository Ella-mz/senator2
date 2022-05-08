<?php

namespace Modules\CostumerClub\Http\Controllers\Invite;

use App\Http\Controllers\Controller;
use Modules\User\Repositories\UserRepository;

class InviteController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateInvitedCode(): \Illuminate\Http\JsonResponse
    {
        $user = $this->userRepository->find_with_invited_code(request('invitedCode'));

        if (!$user){
            return response()->json(['errors'=> 'کد معرف وارد شده در سامانه وجود ندارد']);

        }else
            return response()->json(true);
    }
}

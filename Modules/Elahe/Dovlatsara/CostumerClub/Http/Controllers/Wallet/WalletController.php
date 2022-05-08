<?php

namespace Modules\CostumerClub\Http\Controllers\Wallet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\CostumerClub\Repositories\WalletTransactionRepository;
use Modules\User\Repositories\UserRepository;

class WalletController extends Controller
{
    private $userRepository;
    private $walletRepository;
    private $walletTransactionRepository;

    public function __construct(UserRepository $userRepository, WalletRepository $walletRepository,
                                WalletTransactionRepository $walletTransactionRepository)
    {
        $this->userRepository = $userRepository;
        $this->walletRepository = $walletRepository;
        $this->walletTransactionRepository = $walletTransactionRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function walletComputation(Request $request): \Illuminate\Http\JsonResponse
    {
        $walletValue = $this->convertToEnglish(str_replace(',', '', $request->walletValue));
        $wallet_balance = $this->walletRepository->get_wallet_balance(auth()->user());
        $request->price = (int)($request->price);
        if (is_numeric((int)($walletValue))) {
            if ((int)($walletValue.'0') <= $wallet_balance) {
                if ((int)($walletValue.'0') > $request->price) {
                    $totalPayment = 0;
                    $remain = (int)($wallet_balance) - $request->price;
                    return response()->json([
                        'errors' => 'مبلغ بیش از حد مجاز است.',
                        'totalPayment' => '<p class="title">مبلغ پرداخت:</p><span id="wallet_withdrawal">' . number_format($totalPayment>0?substr($totalPayment, 0, -1):0) . ' تومان</span>',
                        'walletWithdrawal' => '' . number_format(substr($request->price, 0, -1)) . ' تومان', 'walletBalance' => 'موجودی کیف پول شما: ' . number_format($remain>0?substr($remain, 0, -1):0) . ' تومان', 'status' => 200]);
                }
                $totalPayment = ($request->price) - ((int)($walletValue.'0'));
                $remain = ((int)($wallet_balance)) - ((int)($walletValue.'0'));
                return response()->json(['totalPayment' =>
                    '<p class="title">مبلغ پرداخت:</p><span id="wallet_withdrawal">' . number_format($totalPayment>0?substr($totalPayment, 0, -1):0) . ' تومان</span>',
                    'walletWithdrawal' => '' . number_format((int)($walletValue)) . ' تومان', 'walletBalance' => 'موجودی کیف پول شما: ' . number_format($remain>0?substr($remain, 0, -1):0) . ' تومان', 'status' => 200]);
            } else
                return response()->json(['errors' => 'موجودی کیف پول کافی نیست.', 'status' => 403]);

        } else {
            return response()->json(['errors' => 'مبلغ باید شامل عدد باشد.', 'status' => 403]);

        }

//        $user = $this->userRepository->find_with_invited_code(request('invitedCode'));
//
//        if (!$user){
//            return response()->json(['errors'=> 'کد معرف وارد شده در سامانه وجود ندارد']);
//
//        }else
//            return response()->json(true);
    }

    /**
     * @param $price
     * @param $order
     * @return bool
     */
    public
    function create_deactivate_wallet_transaction($price, $order): bool
    {
        if ($price > 0)
            $this->walletTransactionRepository->deactivate_decrease_create($price, $order->id, auth()->user());
        return true;
    }
}

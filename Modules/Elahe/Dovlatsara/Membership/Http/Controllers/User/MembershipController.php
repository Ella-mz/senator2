<?php

namespace Modules\Membership\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\CostumerClub\Repositories\WalletTransactionRepository;
use Modules\Gateway\Http\Controllers\GatewayController;
use Modules\Membership\Repositories\MembershipRepository;
use Modules\Order\Repositories\OrderRepository;
use Modules\Payment\Repositories\PaymentRepository;
use Modules\Setting\Repository\AdminSettingRepository;

class MembershipController extends Controller
{
    private $membershipRepository;
    private $walletRepository;
    private $gatewayController;
    private $saman_MID;
    private $gateway;
    private $adminSettingRepository;
    private $walletTransactionRepository;
    private $orderRepository;
    private $paymentRepository;

    public function __construct(MembershipRepository $membershipRepository, WalletRepository $walletRepository,
                                GatewayController $gatewayController, AdminSettingRepository $adminSettingRepository,
                                WalletTransactionRepository $walletTransactionRepository,
                                OrderRepository $orderRepository, PaymentRepository $paymentRepository)
    {
        $this->walletRepository = $walletRepository;
        $this->gatewayController = $gatewayController;
        $this->membershipRepository = $membershipRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->saman_MID = $this->adminSettingRepository->getAdminSettingByTitle('saman_MID')->value;
        $this->gateway = $this->adminSettingRepository->getAdminSettingByTitle('gateway')->value;
        $this->walletTransactionRepository = $walletTransactionRepository;
        $this->paymentRepository = $paymentRepository;
        $this->orderRepository = $orderRepository;
    }


    public function index()
    {
        $memberships = $this->membershipRepository->getAllActiveMembership();
        return view('Memberships::user.index', compact('memberships'));
    }

    public function buyMembership($membershipId)
    {
        $membership = $this->membershipRepository->membershipFindById($membershipId);
        $mem_ids = $this->membershipRepository->membershipIds();
        $mem_user_ids = $this->membershipRepository->membershipUserIdsByMembershipIds($mem_ids);
        $membership_user = $this->membershipRepository->membershipUserByMembershipUserIds($mem_user_ids);

        if ($membership_user && $membership_user->endDate > Carbon::now()) {
            $startDate = verta($membership_user->endDate)->addDay(1)->datetime()->format('Y-m-d');
        } else {
            $startDate = Carbon::now()->format('Y-m-d');
        }
        $endDate = verta($startDate)->addDay($membership->duration);

        $callbackUrlForFactor = \Illuminate\Support\Facades\URL::previous();
        $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());

        return view('Memberships::user.factor', compact('membership', 'startDate', 'endDate',
            'callbackUrlForFactor', 'current_balance'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay(Request $request): \Illuminate\Http\RedirectResponse
    {
        $membership = $this->membershipRepository->membershipFindById($request->id);
        $request->wallet_value = $this->convertToEnglish(str_replace(',', '', $request->wallet_value));
        $wallet_balance = $this->walletRepository->get_wallet_balance(auth()->user());

        $mem_ids = [];
//        $mem_ids = $this->repo->membershipIdsByRoleTypeAndPackageType($membership->role_type, $membership->package_type);
        $mem_user_ids = $this->membershipRepository->membershipUserIdsByMembershipIds($mem_ids);
        $membership_user = $this->membershipRepository->membershipUserByMembershipUserIds($mem_user_ids);
        if ($membership_user && $membership_user->endDate > Carbon::now()) {
            $startDate = verta($membership_user->endDate)->addDay(1)->datetime()->format('Y-m-d');
        } else {
            $startDate = Carbon::now()->format('Y-m-d');
        }
        $endDate = verta($startDate)->addDay($membership->duration);

        if (isset($request->isWallet) && is_numeric($request->wallet_value) && $request->walletValue <= $wallet_balance)
            $price = $membership->price - $request->wallet_value;
        else
            $price = $membership->price;

        $array = [
            'price' => $price,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
        $result = $this->gatewayController->index($array);
        if (!$result)
            return redirect()->route('membership.gateway_start_error.user');
        $order = $this->orderRepository->create($request, 'membership');
        $payment = $this->paymentRepository->create($request, $order, $result, $this->gateway, $this->saman_MID,
            'user', \url()->route('membership.index.user'));

        if (isset($request->isWallet))
            $this->walletTransactionRepository->deactivate_decrease_create($request->wallet_value, $order->id, auth()->user());
        if (isset($request->isWallet) && $payment->payment_fee == 0) {
            $payment->update([
                'status' => 'paid',
                'date' => Verta::now(),
            ]);
            $order = $payment->order;
            $order->update([
                'status' => 'paid',
            ]);
            auth()->user()->memberships()->attach($membership->id,
                [
                    'startDate' => $startDate,
                    'endDate' => $endDate->datetime()->format('Y-m-d'),
                    'score' => $membership->score,
                    'remain_score' => $membership->score
                ]);
            return redirect(\url($payment->call_back_route_name));
        }
        return redirect()->route('start_gateway', [
            'merchant_code' => $result['merchant_code'],
            'resNum' => $result['resNum'],
            'gateway' => $result['gateway']]);
    }

    public function startError()
    {
        return view('Memberships::realestate.startError');
    }

    public function callbackError()
    {
        return view('Memberships::realestate.callbackError');
    }

}

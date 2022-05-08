<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Ad\Entities\Ad;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\ApplicantMembership\Entities\ApplicantMembership;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\CostumerClub\Repositories\WalletTransactionRepository;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\Membership\Repositories\MembershipRepository;
use Modules\Order\Repositories\OrderRepository;
use Modules\Payment\Entities\Payment;

class OrderController extends Controller
{
    private $repo;
    private $membershipRepository;
    private $walletTransactionRepository;
    private $walletRepository;

    public function __construct(OrderRepository $orderRepository, MembershipRepository $membershipRepository,
                                WalletTransactionRepository $walletTransactionRepository, WalletRepository $walletRepository)
    {
        $this->repo = $orderRepository;
        $this->membershipRepository = $membershipRepository;
        $this->walletTransactionRepository = $walletTransactionRepository;
        $this->walletRepository = $walletRepository;
    }

    /**
     * @param $orderId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function factor($orderId)
    {
        $order = $this->repo->findOrderById($orderId);
        return view('Orders::factor', compact('order'));
    }

    /**
     * @param $result
     * @param $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function change_order($result, $request)
    {
        $payment = Payment::where('resNum', $request->ResNum)->first();
        Auth::loginUsingId($payment->order->user_id);

        $payment->update([
            'refId' => $result['RefNum'],
            'status' => 'paid',
            'date' => Verta::now(),
        ]);
        $order = $payment->order;
        $order->update([
            'status' => 'paid',
        ]);
        $walletTransactions = $this->walletTransactionRepository->find_deactivate_transactions($order);
        foreach ($walletTransactions as $transaction)
            $this->walletTransactionRepository->update($transaction, ['status' => 'active']);
        $wallet = $this->walletRepository->find(\auth()->user());
        $this->walletRepository->decrease($wallet);

        if ($order->type == 'membership') {
            $membership = $this->membershipRepository->membershipFindById($payment->order->type_id);
            $mem_ids = $this->membershipRepository->membershipIdsByRoleTypeAndPackageType($membership->role_type, $membership->package_type);
            $mem_user_ids = $this->membershipRepository->membershipUserIdsByMembershipIds($mem_ids);
            $membership_user = $this->membershipRepository->membershipUserByMembershipUserIds($mem_user_ids);
            if ($membership_user && $membership_user->endDate > Carbon::now()) {
                $startDate = verta($membership_user->endDate)->addDay(1)->datetime()->format('Y-m-d');
            } else {
                $startDate = Carbon::now()->format('Y-m-d');
            }
            $endDate = verta($startDate)->addDay($membership->duration);

            auth()->user()->memberships()->attach($membership->id,
                [
                    'startDate' => $startDate,
                    'endDate' => $endDate->datetime()->format('Y-m-d'),
                    'number_of_allowed_ads' => $membership->number_of_allowed_ads
                ]);

        } elseif ($order->type == 'applicantMembership') {
            $applicantMembership = ApplicantMembership::find($payment->order->type_id);
            $mem_ids = ApplicantMembership::where('role_type', $applicantMembership->role_type)
                ->pluck('id')->toArray();
            $mem_user_ids = DB::table('applicant_membership_user')->where('user_id', \auth()->id())
                ->whereIn('applicant_membership_id', $mem_ids)->pluck('id')->toArray();
            $applicant_membership_user = DB::table('applicant_membership_user')->whereIn('id', $mem_user_ids)
                ->where('user_id', \auth()->id())->orderByDesc('endDate')->first();
            if ($applicant_membership_user && $applicant_membership_user->remain_number_of_applications > 0
                && $applicant_membership_user->endDate > Carbon::now()) {
                \alert()->error('', 'درحال حاضر حق اشتراک خریداری شده ی شما به پایان نرسیده است');
                return redirect()->back();
            }
            if ($applicant_membership_user && $applicant_membership_user->endDate > Carbon::now()) {
                $startDate = verta($applicant_membership_user->endDate)->addDay(1)->datetime()->format('Y-m-d');
            } else {
                $startDate = Carbon::now()->format('Y-m-d');
            }
            $endDate = verta($startDate)->addDay($applicantMembership->duration);
            auth()->user()->applicantMemberships()->attach($applicantMembership->id,
                [
                    'startDate' => $startDate,
                    'endDate' => $endDate->datetime()->format('Y-m-d'),
                    'remain_number_of_applications' => $applicantMembership->number_of_applications,
                    'number_of_applications' => $applicantMembership->number_of_applications,
                ]);
        } elseif ($order->type == 'advertisement') {

            $advertisingApplication = AdvertisingApplication::find($payment->order->type_id);
            $advertisingApplication->update([
                'isPaid'=>1
            ]);

        }elseif($order->type == 'ad'){
            $ad = Ad::find($payment->order->type_id);
            $ad->update([
                'paymentType' => 'adFee',
                'isPaid' => 'paid',
            ]);
        } elseif ($order->type == 'hologram') {

            $hologramInterface = HologramInterface::find($payment->order->type_id);
            $hologramInterface->update([
                'isPaid'=>1
            ]);

        }else{
            Auth::loginUsingId($payment->order->user_id);
            toast('عملیات برگشت از پرداخت با خطا مواجه شد شد', 'error')->background('#f27474')->timerProgressBar();
            return redirect(\url($payment->call_back_route_name));
        }
        return $payment;
    }
}

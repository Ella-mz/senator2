<?php

namespace Modules\Membership\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\CostumerClub\Repositories\WalletTransactionRepository;
use Modules\EnumType\Repositories\EnumTypeRepository;
use Modules\Gateway\Http\Controllers\GatewayController;
use Modules\Membership\Repositories\MembershipRepository;
use Modules\Order\Repositories\OrderRepository;
use Modules\Payment\Repositories\PaymentRepository;
use Modules\Setting\Repository\AdminSettingRepository;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Entities\User;

class MembershipController extends Controller
{
    private $repo;
    private $orderRepository;
    private $paymentRepository;
    private $adminSettingRepository;
    private $gatewayController;
    private $saman_MID;
    private $gateway;
    private $walletRepository;
    private $walletTransactionRepository;
    private $settingRepository;
    private $enumTypeRepository;

    public function __construct(MembershipRepository $membershipRepository,
                                OrderRepository $orderRepository, PaymentRepository $paymentRepository,
                                AdminSettingRepository $adminSettingRepository, GatewayController $gatewayController,
                                WalletRepository $walletRepository, WalletTransactionRepository $walletTransactionRepository,
                                SettingRepository $settingRepository, EnumTypeRepository $enumTypeRepository)
    {
        $this->repo = $membershipRepository;
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->gatewayController = $gatewayController;
        $this->saman_MID = $this->adminSettingRepository->getAdminSettingByTitle('saman_MID')->value;
        $this->gateway = $this->adminSettingRepository->getAdminSettingByTitle('gateway')->value;
        $this->walletRepository = $walletRepository;
        $this->walletTransactionRepository = $walletTransactionRepository;
        $this->settingRepository = $settingRepository;
        $this->enumTypeRepository = $enumTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $submit_general_ad_score = $this->enumTypeRepository->findEnumTypeByTitle('submit_general_ad_score')->link;
        $submit_scalar_ad_score = $this->enumTypeRepository->findEnumTypeByTitle('submit_scalar_ad_score')->link;
        $submit_emergency_ad_score = $this->enumTypeRepository->findEnumTypeByTitle('submit_emergency_ad_score')->link;
        $see_application_score = $this->enumTypeRepository->findEnumTypeByTitle('see_application_score')->link;
        $memberships = $this->repo->getAllActiveMembership();
//        $applicant_memberships = $this->repo->applicantMembershipsFindByRoleType($role);
        return view('Memberships::realestate.index', compact('memberships',
            'submit_general_ad_score', 'submit_scalar_ad_score', 'submit_emergency_ad_score',
            'see_application_score'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($userId)
    {

        $memberships = $this->repo->findUserById($userId)->memberships;
        $applicant_memberships = $this->repo->findUserById($userId)->applicantMemberships;
        return view('Memberships::realestate.show', compact('memberships', 'applicant_memberships'));
    }

    /**
     * @param $membershipId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function buyMembership($membershipId)
    {
        $membership = $this->repo->membershipFindById($membershipId);
        $mem_ids = $this->repo->membershipIds();
//        $mem_ids = $this->repo->membershipIdsByRoleTypeAndPackageType($membership->role_type, $membership->package_type);
        $mem_user_ids = $this->repo->membershipUserIdsByMembershipIds($mem_ids);
        $membership_user = $this->repo->membershipUserByMembershipUserIds($mem_user_ids);

        if ($membership_user && $membership_user->endDate > Carbon::now()) {
            $startDate = verta($membership_user->endDate)->addDay(1)->datetime()->format('Y-m-d');
        } else {
            $startDate = Carbon::now()->format('Y-m-d');
        }
        $endDate = verta($startDate)->addDay($membership->duration);

        $callbackUrlForFactor = \Illuminate\Support\Facades\URL::previous();
        $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());

//          $array = ['startDate'=>$startDate, 'endDate'=>$endDate, 'id'=>$membership->id, 'type'=>'membership'];
//        $order=Order::create([
//           'user_id'=>\auth()->id(),
//           'type'=>'membership',
//           'type_id'=> $membershipId,
//            'price'=>$membership->price,
//            'status'=>'unpaid',
//            'description'=>'حق اشتراک شما از تاریخ '.\verta($startDate)->formatJalaliDate().' تا تاریخ '.\verta($endDate)->formatJalaliDate().' معتبر است',
//        ]);
//        \session(['dataOfFactor' => $array]);
//        auth()->user()->memberships()->attach($membership->id,
//            [
//                'startDate' => $startDate,
//                'endDate' => $endDate->datetime()->format('Y-m-d'),
//                'number_of_allowed_ads' => $membership->number_of_allowed_ads
//            ]);
//        Alert::success('', 'سفارش شما با موفقیت ثبت شد');
//        return redirect(route('factor.payment.panel'));
        return view('Memberships::realestate.factor', compact('membership', 'startDate', 'endDate',
            'callbackUrlForFactor', 'current_balance'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay(Request $request): \Illuminate\Http\RedirectResponse
    {
        $membership = $this->repo->membershipFindById($request->id);
        $request->wallet_value = $this->convertToEnglish(str_replace(',', '', $request->wallet_value));
        $wallet_balance = $this->walletRepository->get_wallet_balance(auth()->user());

        $mem_ids = [];
//        $mem_ids = $this->repo->membershipIdsByRoleTypeAndPackageType($membership->role_type, $membership->package_type);
        $mem_user_ids = $this->repo->membershipUserIdsByMembershipIds($mem_ids);
        $membership_user = $this->repo->membershipUserByMembershipUserIds($mem_user_ids);
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
            return redirect()->route('membership.gateway_start_error.panel');
        $order = $this->orderRepository->create($request, 'membership');
        $payment = $this->paymentRepository->create($request, $order, $result, $this->gateway, $this->saman_MID,
            'panel', \url()->route('membership.show.realestate', \auth()->id()));
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

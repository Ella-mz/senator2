<?php

namespace Modules\ApplicantMembership\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\ApplicantMembership\Entities\ApplicantMembership;
use Modules\ApplicantMembership\Http\Requests\Admin\StoreRequest;
use Modules\ApplicantMembership\Http\Requests\Admin\UpdateRequest;
use Modules\ApplicantMembership\Repositories\ApplicantMembershipRepository;
use Modules\Category\Entities\Category;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\CostumerClub\Repositories\WalletTransactionRepository;
use Modules\Gateway\Http\Controllers\GatewayController;
use Modules\Order\Repositories\OrderRepository;
use Modules\Payment\Repositories\PaymentRepository;
use Modules\Setting\Repository\AdminSettingRepository;
use RealRashid\SweetAlert\Facades\Alert;

class ApplicantMembershipController extends Controller
{
    private $applicantMembershipRepository;
    private $gatewayController;
    private $orderRepository;
    private $paymentRepository;
    private $adminSettingRepository;
    private $gateway;
    private $saman_MID;
    private $walletRepository;
    private $walletTransactionRepository;

    public function __construct(ApplicantMembershipRepository $applicantMembershipRepository, GatewayController $gatewayController,
                                OrderRepository $orderRepository, PaymentRepository $paymentRepository,
                                AdminSettingRepository $adminSettingRepository, WalletRepository $walletRepository,
                                WalletTransactionRepository $walletTransactionRepository)
    {
        $this->applicantMembershipRepository = $applicantMembershipRepository;
        $this->gatewayController = $gatewayController;
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->gateway = $this->adminSettingRepository->getAdminSettingByTitle('gateway')->value;
        $this->saman_MID = $this->adminSettingRepository->getAdminSettingByTitle('saman_MID')->value;
        $this->walletRepository = $walletRepository;
        $this->walletTransactionRepository = $walletTransactionRepository;
    }

    /**
     * @param ApplicantMembership $applicantMembership
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function buyApplicantMembership(ApplicantMembership $applicantMembership)
    {
        $mem_ids = ApplicantMembership::where('role_type', $applicantMembership->role_type)
            ->pluck('id')->toArray();
        $mem_user_ids = DB::table('applicant_membership_user')->where('user_id', \auth()->id())
            ->whereIn('applicant_membership_id', $mem_ids)->pluck('id')->toArray();
        $applicant_membership_user = DB::table('applicant_membership_user')->whereIn('id', $mem_user_ids)
            ->where('user_id', \auth()->id())->orderByDesc('endDate')->first();

        if ($applicant_membership_user && $applicant_membership_user->remain_number_of_applications > 0
            && $applicant_membership_user->endDate > Carbon::now()) {
            Alert::error('', 'درحال حاضر حق اشتراک خریداری شده ی شما به پایان نرسیده است');
            return redirect()->back();
        }
        if ($applicant_membership_user && $applicant_membership_user->endDate > Carbon::now()) {
            $startDate = verta($applicant_membership_user->endDate)->addDay(1)->datetime()->format('Y-m-d');
        } else {
            $startDate = Carbon::now()->format('Y-m-d');

        }
        $endDate = verta($startDate)->addDay($applicantMembership->duration);
        $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());

//        Auth::user()->applicantMemberships()->attach($applicantMembership->id,
//            [
//                'startDate' => $startDate,
//                'endDate' => $endDate->datetime()->format('Y-m-d'),
//                'remain_number_of_applications' => $applicantMembership->number_of_applications,
//                'number_of_applications' => $applicantMembership->number_of_applications,
//            ]);
//        toast('پرداخت با موفقیت انجام شد', 'success')->background('#e6ffe6')->timerProgressBar();

//        Alert::success('', 'حق اشتراک با موفقیت خریداری شد');
        $callbackUrlForFactor = \Illuminate\Support\Facades\URL::previous();

        return view('ApplicantMemberships::realestate.factor',
            compact('applicantMembership', 'startDate', 'endDate', 'callbackUrlForFactor', 'current_balance'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay(Request $request): \Illuminate\Http\RedirectResponse
    {
        $applicantMembership = $this->applicantMembershipRepository->applicantMembershipFindById($request->id);
        $request->wallet_value = $this->convertToEnglish(str_replace(',', '', $request->wallet_value));
        $wallet_balance = $this->walletRepository->get_wallet_balance(auth()->user());
        $mem_ids = ApplicantMembership::where('role_type', $applicantMembership->role_type)
            ->pluck('id')->toArray();
        $mem_user_ids = DB::table('applicant_membership_user')->where('user_id', \auth()->id())
            ->whereIn('applicant_membership_id', $mem_ids)->pluck('id')->toArray();
        $applicant_membership_user = DB::table('applicant_membership_user')->whereIn('id', $mem_user_ids)
            ->where('user_id', \auth()->id())->orderByDesc('endDate')->first();
        if ($applicant_membership_user && $applicant_membership_user->remain_number_of_applications > 0
            && $applicant_membership_user->endDate > Carbon::now()) {
            Alert::error('', 'درحال حاضر حق اشتراک خریداری شده ی شما به پایان نرسیده است');
            return redirect()->back();
        }
        if ($applicant_membership_user && $applicant_membership_user->endDate > Carbon::now()) {
            $startDate = verta($applicant_membership_user->endDate)->addDay(1)->datetime()->format('Y-m-d');
        } else {
            $startDate = Carbon::now()->format('Y-m-d');

        }
        $endDate = verta($startDate)->addDay($applicantMembership->duration);
        if (isset($request->isWallet) && is_numeric($request->wallet_value) && $request->walletValue <= $wallet_balance)
            $price = $applicantMembership->price - $request->wallet_value;
        else
            $price = $applicantMembership->price;

//        $mem_ids = $this->applicantMembershipRepository->membershipIdsByRoleTypeAndPackageType($membership->role_type, $membership->package_type);
//        $mem_user_ids = $this->repo->membershipUserIdsByMembershipIds($mem_ids);
//        $membership_user = $this->repo->membershipUserByMembershipUserIds($mem_user_ids);
//        if ($membership_user && $membership_user->endDate > Carbon::now()) {
//            $startDate = $membership_user->endDate;
//        } else {
//            $startDate = Carbon::now()->format('Y-m-d');
//        }
//        $endDate = verta($startDate)->addDay($membership->duration);
        $array = [
            'price' => $price,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];
        $result = $this->gatewayController->index($array);
        if (!$result)
            return redirect()->route('applicantMembership.gateway_start_error.panel');
        $order = $this->orderRepository->create($request, 'applicantMembership');
        $payment = $this->paymentRepository->create($request, $order, $result, $this->gateway, $this->saman_MID,
            'panel', \url()->route('membership.show.realestate', \auth()->id()));
        $this->walletTransactionRepository->deactivate_decrease_create($request->wallet_value, $order->id, auth()->user());

        return redirect()->route('start_gateway', [
            'merchant_code' => $result['merchant_code'],
            'resNum' => $result['resNum'],
            'gateway' => $result['gateway']]);

    }

    public function startError()
    {
        return view('ApplicantMemberships::realestate.startError');
    }

    public function callbackError()
    {
        return view('ApplicantMemberships::realestate.callbackError');
    }
}

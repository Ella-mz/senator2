<?php

namespace Modules\Hologram\Http\Controllers\Realestate;

use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Modules\Ad\Entities\Ad;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\CostumerClub\Repositories\WalletTransactionRepository;
use Modules\Gateway\Http\Controllers\GatewayController;
use Modules\Hologram\Entities\Hologram;
use Modules\Hologram\Http\Traits\chooseExpertTrait;
use Modules\Hologram\Http\Traits\StoreHologramInterfaceTrait;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\HologramInterface\Entities\HologramInterfaceFile;
use Modules\HologramInterface\Repositories\HologramInterfaceRepository;
use Modules\Order\Repositories\OrderRepository;
use Modules\Payment\Repositories\PaymentRepository;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Entities\AdminSetting;
use Modules\Setting\Repository\AdminSettingRepository;
use Illuminate\Support\Facades\Validator;

class HologramController extends Controller
{
    use StoreHologramInterfaceTrait, chooseExpertTrait;

    private $gatewayController;
    private $orderRepository;
    private $paymentRepository;
    private $adminSettingRepository;
    private $gateway;
    private $saman_MID;
    private $walletRepository;
    private $hologramInterfaceRepository;
    private $walletTransactionRepository;

    public function __construct(GatewayController $gatewayController, HologramInterfaceRepository $hologramInterfaceRepository,
                                OrderRepository $orderRepository, PaymentRepository $paymentRepository,
                                AdminSettingRepository $adminSettingRepository, WalletRepository $walletRepository,
                                WalletTransactionRepository $walletTransactionRepository)
    {
        $this->gatewayController = $gatewayController;
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->gateway = $this->adminSettingRepository->getAdminSettingByTitle('gateway')->value;
        $this->saman_MID = $this->adminSettingRepository->getAdminSettingByTitle('saman_MID')->value;
        $this->walletRepository = $walletRepository;
        $this->hologramInterfaceRepository = $hologramInterfaceRepository;
        $this->walletTransactionRepository = $walletTransactionRepository;
    }

    public function convertToEnglish($string)
    {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        //dd(str_replace($persian, $newNumbers, $string));
        return str_replace($persian, $newNumbers, $string);
    }

    /**
     * Display a listing of the resource.
     * @param $type
     * @param $id
     * @return Renderable
     */
    public function index($type, $id)
    {
        $holograms = Hologram::where('type', $type)->get();
        return view('Holograms::realestate.index', compact('holograms', 'type', 'id'));
    }

    /**
     * Show the form for the specified resource.
     * @param Hologram $hologram
     * @param $id
     * @return Renderable
     */
    public function choose(Hologram $hologram, $id)
    {
        foreach (HologramInterface::where('type', $hologram->type)->where('type_id', $id)->get() as $hologramInterface) {
            if ($hologramInterface->status == 'pending' && $hologramInterface->isPaid == 1) {
                \alert()->error('', 'درحال حاضر یک هولوگرام درحال بررسی دارید ');
                return redirect()->back();
            }
            if ($hologramInterface->status == 'approved') {
                \alert()->error('', 'درحال حاضر یک هولوگرام تایید شده دارید ');
                return redirect()->back();
            }
        }
        return view('Holograms::realestate.show', compact('hologram', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function apply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hologram_id' => 'required',
            'type_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $hologram = Hologram::find($request->hologram_id);
        foreach (HologramInterface::where('type', $hologram->type)->where('type_id', $request->type_id)->get() as $hologramInterface) {
            if ($hologramInterface->status == 'pending' && $hologramInterface->isPaid == 1) {
                \alert()->error('', 'درحال حاضر یک هولوگرام درحال بررسی دارید ');
                return redirect()->back();
            }
            if ($hologramInterface->status == 'approved') {
                \alert()->error('', 'درحال حاضر یک هولوگرام تایید شده دارید ');
                return redirect()->back();
            }
        }
        $expert_ids = DB::table('role_user')->where('role_id', Role::where('slug', 'expert')->first()->id)
            ->pluck('user_id')->toArray();

        if (AdminSetting::where('title', 'hologram_publish')->first()->value == 'manual' || count($expert_ids) <= 0) {
            $hologram_interface = $this->storeHologramInterfaceWithFiles($request->all());
        } elseif (AdminSetting::where('title', 'hologram_publish')->first()->value == 'auto') {
            $expert_id = $this->selectExpert();
            $hologram_interface = $this->storeHologramInterfaceWithFilesAuto($request->all(), $expert_id);
        }
        $callbackUrlForFactor = URL::previous();
        $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());

        return view('Holograms::realestate.factor', compact('hologram_interface', 'callbackUrlForFactor',
            'hologram', 'current_balance'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->wallet_value = $this->convertToEnglish(str_replace(',', '', $request->wallet_value));
        $wallet_balance = $this->walletRepository->get_wallet_balance(auth()->user());

        $hologram_interface = $this->hologramInterfaceRepository->hologramInterfaceFindById($request->id);
        if (isset($request->isWallet) && is_numeric($request->wallet_value) && $request->walletValue <= $wallet_balance)
            $price = $hologram_interface->hologram_price - $request->wallet_value;
        else
            $price = $hologram_interface->hologram_price;

        $array = [
            'price' => $price,
        ];
        $result = $this->gatewayController->index($array);
        if (!$result)
            return redirect()->route('holograms.gateway_start_error.panel');
        $order = $this->orderRepository->create($request, 'hologram');
        $payment = $this->paymentRepository->create($request, $order, $result, $this->gateway, $this->saman_MID,
            'panel', \url()->route('hologram.index.realestate',
                ['type' => $hologram_interface->hologram->type, 'id' => $hologram_interface->type_id]));
        if (isset($request->isWallet))
            $this->walletTransactionRepository->deactivate_decrease_create($request->wallet_value, $order->id, auth()->user());
        if (isset($request->isWallet) && $payment->payment_fee==0){
            $payment->update([
                'status' => 'paid',
                'date' => Verta::now(),
            ]);
            $order = $payment->order;
            $order->update([
                'status' => 'paid',
            ]);
            $hologram_interface->update([
                'isPaid'=>1
            ]);
            return redirect(\url($payment->call_back_route_name));
        }
        return redirect()->route('start_gateway',
            [
                'merchant_code' => $result['merchant_code'],
                'resNum' => $result['resNum'],
                'gateway' => $result['gateway']
            ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function myHolograms()
    {
        $user_holograms = HologramInterface::where('type', 'user')->where('type_id', \auth()->id())->where('isPaid', 1)->orderByDesc('created_at')->get();
        $ad_ids = Ad::where('user_id', \auth()->id())->pluck('id')->toArray();
        $ad_holograms = HologramInterface::where('type', 'ad')->whereIn('type_id', $ad_ids)->where('isPaid', 1)->orderByDesc('created_at')->get();
        return view('Holograms::realestate.myHolograms', compact('user_holograms', 'ad_holograms'));
    }

    public function myHologram(HologramInterface $hologramInterface)
    {
        return view('Holograms::realestate.myHologram', compact('hologramInterface'));

    }

    public function startError()
    {
        return view('Holograms::realestate.startError');
    }

    public function callbackError()
    {
        return view('Holograms::realestate.callbackError');
    }

    public function download(HologramInterfaceFile $hologramInterfaceFile)
    {
        return response()->download($hologramInterfaceFile->file_address, $hologramInterfaceFile->file_name);
    }
}

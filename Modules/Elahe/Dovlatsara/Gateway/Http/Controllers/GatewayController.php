<?php

namespace Modules\Gateway\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Gateway\Http\Traits\ZarinPal;
use Modules\Gateway\Http\Traits\BehPardakhtMellat;
use Modules\Gateway\Http\Traits\Saman;
use Modules\Order\Http\Controllers\OrderController;
use Modules\Payment\Entities\Payment;
use Modules\Setting\Repository\AdminSettingRepository;

class GatewayController extends Controller
{
    use ZarinPal;
    use BehPardakhtMellat;
    use Saman;

    private $orderController;
    private $settingRepository;
    private $gateway;
    private $call_back_url;
    private $adminSettingRepository;
    private $saman_MID;
    private $gateway_callbackurl;

    public function __construct(OrderController $orderController, AdminSettingRepository $adminSettingRepository)
    {
        $this->orderController = $orderController;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->gateway = $this->adminSettingRepository->getAdminSettingByTitle('gateway')->value;
        $this->call_back_url = $this->adminSettingRepository->getAdminSettingByTitle('gateway_callbackurl')->value;
        $this->saman_MID = $this->adminSettingRepository->getAdminSettingByTitle('saman_MID')->value;

    }

    public function index($array)
    {
        switch ($this->gateway) {
            case 'zarinpal':
                $result = $this->zarinpal_index($array);
                break;
            case 'beh_pardakht_mellat':
                $result = $this->mellat_index($array);
                break;
            case 'saman':
                $result = $this->saman_index($array);
                break;
        }
        return !$result ? false : ['merchant_code' => $result['token'], 'resNum' => $result['resNum'] ?? null, 'gateway' => $this->gateway];
    }


    public function start_gateway($merchant_id, $resNum, $gateway)
    {
        switch ($this->gateway) {
            case 'zarinpal':
                return redirect('https://www.zarinpal.com/pg/StartPay/' . $merchant_id);
            case 'beh_pardakht_mellat':
                return redirect()->route('start_gateway.beh_pardakht_mellat');
//                return view('gateway::mellat.index', compact('merchant_id'));
            case 'saman':
                return redirect()->route('start_gateway.saman', $merchant_id);
//                return view('gateway::saman.index', ['merchant_id' => $this->saman_MID, 'call_back_url' => $this->call_back_url]);
        }
    }


    public function callback(Request $request)
    {
        switch ($this->gateway) {
            case 'zarinpal':
                $result = $this->zarinpal_verify($request->Authority, $request->Status, $request->Amount);
                break;
            case 'beh_pardakht_mellat':
                $result = $this->mellat_verify($request);
                break;
            case 'saman':
                $result = $this->saman_verify($request->State, $request->RefNum, $request->ResNum, $request->Token);
                break;
        }
        if (!$result)
            return redirect()->route('gateway_error');
        if ($result=='redirect'){
            $payment = Payment::where('resNum', $request->ResNum)->first();
            Auth::loginUsingId($payment->order->user_id);
            toast('عملیات پرداخت لغو شد', 'info')->background('#3fc3ee')->timerProgressBar();
            return redirect(\url($payment->call_back_route_name));
        }
        $payment = $this->orderController->change_order($result, $request);

        toast('پرداخت با موفقیت انجام شد', 'success')->background('#e6ffe6')->timerProgressBar();
        return redirect(\url($payment->call_back_route_name));
    }


    public function error()
    {
        return view('gateway::error');
    }

    public function start_gateway_saman($merchant_id)
    {
        return view('gateway::saman.index', ['merchant_id' => $merchant_id, 'call_back_url' => $this->call_back_url]);
    }

    public function start_gateway_beh_pardakht_mellat($merchant_id)
    {
        return view('gateway::mellat.index', compact('merchant_id'));
    }
}

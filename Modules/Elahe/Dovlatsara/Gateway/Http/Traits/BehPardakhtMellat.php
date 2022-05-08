<?php

namespace Modules\Gateway\Http\Traits;

use Carbon\Carbon;
use http\Env\Request;
use Modules\Setting\Repository\AdminSettingRepository;
use SoapClient;

trait BehPardakhtMellat
{
    private $settingRepository;

    public function __construct(AdminSettingRepository $adminSettingRepository)
    {
        $this->settingRepository = $adminSettingRepository;
        $this->mellat_terminalId = $this->settingRepository->get_str_value('mellat_terminalId');
        $this->mellat_userName = $this->settingRepository->get_str_value('mellat_userName');
        $this->mellat_password = $this->settingRepository->get_str_value('mellat_password');
        $this->gateway_callbackurl = $this->settingRepository->get_str_value('gateway_callbackurl');

    }

    public function mellat_index($array)
    {
        $settingRepository = new SettingRepository();
        $this->mellat_terminalId = $this->settingRepository->get_str_value('mellat_terminalId');
        $this->mellat_userName = $this->settingRepository->get_str_value('mellat_userName');
        $this->mellat_password = $this->settingRepository->get_str_value('mellat_password');
        $this->gateway_callbackurl = $this->settingRepository->get_str_value('gateway_callbackurl');

        $parameters = [
            'terminalId' => $this->mellat_terminalId,
            'userName' => $this->mellat_userName,
            'userPassword' => $this->mellat_password,
            'orderId' => '98@487#53*',
            'amount' => $array['Amount'] . '0',
            'localDate' => Carbon::now()->format('Ymd'),
            'localTime' => Carbon::now()->format('Hms'),
            'additionalData' => $array['Description'],
            'callBackUrl' => $this->gateway_callbackurl,
            'payerId' => 0
        ];

        try {
            $client = new SoapClient('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl', array('encoding' => 'UTF-8')); // اتصال به وب سرویس شاپرک با یونیکد UTF-۸

        } catch (Exception $e) {
            return false;
        }
        $result = $client->bpPayRequest($parameters); // اتصال به متد پرداخت بانک ملت و ارسال پارامترهای پرداخت
        $res_code = $this->verify_start_pay_request($result);
        return ['token'=>$res_code];

    }

    public function verify_start_pay_request($result)
    {

        $res = explode(',', $result->return);
        $ResCode = $res[0];
        if ($ResCode == "0") {
            return $res[1];
        } else {
            return false;

        }

    }

    public function mellat_verify($request)
    {
        $settingRepository = new SettingRepository();
        $this->mellat_terminalId = $this->settingRepository->get_str_value('mellat_terminalId');
        $this->mellat_userName = $this->settingRepository->get_str_value('mellat_userName');
        $this->mellat_password = $this->settingRepository->get_str_value('mellat_password');
        $this->gateway_callbackurl = $this->settingRepository->get_str_value('gateway_callbackurl');

        if ($request->ResCode == '0') {
            //--پرداخت در بانک باموفقیت بوده
            $client = new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
            $namespace = 'http://interfaces.core.sw.bps.com/';

            $parameters = [
                'terminalId' => $this->mellat_terminalId,
                'userName' => $this->mellat_userName,
                'userPassword' => $this->mellat_userName,
                'orderId' => $request->SaleOrderId,
                'saleOrderId' => $request->SaleOrderId,
                'saleReferenceId' => $request->SaleReferenceId,
            ];
            // Call the SOAP method
            $result = $client->call('bpVerifyRequest', $parameters, $namespace);
            if ($result == '0') {
                //-- وریفای به درستی انجام شد٬ درخواست واریز وجه
                $result = $client->call('bpSettleRequest', $parameters, $namespace);
                if ($result == '0') {
                    //-- تمام مراحل پرداخت به درستی انجام شد.
                    return $request->RefId;
                }
            }
            //-- وریفای به مشکل خورد٬ نمایش پیغام خطا و بازگشت زدن مبلغ
            $client->call('bpReversalRequest', $parameters, $namespace);
            return false;
        }
    }
}

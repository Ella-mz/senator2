<?php

namespace Modules\Gateway\Http\Traits;

use http\Env\Request;
use Modules\Setting\Repositores\SettingRepository;
use SoapClient;

trait ZarinPal
{
    private $settingRepository;
    private $zarinpal_merchant_id;
    private $gateway_callbackurl;


    public function zarinpal_index($array)
    {
        $settingRepository = new SettingRepository();
        $this->zarinpal_merchant_id = $this->settingRepository->get_str_value('zarinpal_merchant_id');
        $this->gateway_callbackurl = $this->settingRepository->get_str_value('gateway_callbackurl');
        $client = new SoapClient($this->zarinpalMode(), ['encoding' => 'UTF-8']);
        $result = $client->PaymentRequest(
            [
                'MerchantID' => $this->zarinpal_merchant_id,
                'Amount' => $array['Amount'],
                'Description' => $array['Description'],
                'Email' => $array['Email'],
                'Mobile' => $array['Mobile'],
                'CallbackURL' =>$this->gateway_callbackurl,
            ]
        );
        if ($result->Status == 100)
            return ['token'=>$result->Authority];
        else
            return false;
    }
    public function zarinpal_verify( $Authority,$Status,$Amount)
    {
        $settingRepository = new SettingRepository();
        $this->zarinpal_merchant_id = $this->settingRepository->get_str_value('zarinpal_merchant_id');
        if ($Status== 'OK') {

            $client = new SoapClient($this->zarinpalMode(), ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' =>$this->zarinpal_merchant_id,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100)
                return $result->RefID;
            else
                return false;

        } else
            return false;
    }
    public function zarinpalMode()
    {
        return env('ZARINPAL_TEST')? 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl':'https://www.zarinpal.com/pg/services/WebGate/wsdl';
    }
}

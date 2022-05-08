<?php

namespace Modules\Gateway\Http\Traits;

use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Payment\Entities\Payment;
use Modules\Setting\Repository\AdminSettingRepository;
use SoapClient;

trait Saman
{
//    private $adminSettingRepository;
//    private $gateway_callbackurl;
//    private $saman_callbackurl;
//    private $saman_MID;

//    public function __construct(AdminSettingRepository $adminSettingRepository)
//    {
//        $this->adminSettingRepository = $adminSettingRepository;
//        $this->saman_MID = $this->adminSettingRepository->getAdminSettingByTitle('saman_MID')->value;
////        $this->saman_callbackurl = $this->settingRepository->get_str_value('saman_callbackurl');
////        $this->mellat_password = $this->settingRepository->get_str_value('mellat_password');
//        $this->gateway_callbackurl = $this->settingRepository->get_str_value('gateway_callbackurl');
//    }

    public function saman_index($array)
    {
//        $settingRepository = new SettingRepository();
//        $this->saman_callbackurl = $this->settingRepository->get_str_value('saman_callbackurl');
//        $this->saman_MID = $this->settingRepository->get_str_value('saman_MID');

        $price       = $array['price'];
//        $callbackUrl = $this->saman_callbackurl;
        $MID=$this->saman_MID;
//        dd($this->adminSettingRepository->getAdminSettingByTitle('saman_MID')->value);
//        dd($MID);
        $orderId = $this->randNumber();
        $client =  new SoapClient('https://sep.shaparak.ir/payments/initpayment.asmx?wsdl');
//        dd($client);
        try
        {
            $token = $client->RequestToken(
                $MID,           /// MID
                $orderId,       /// ResNum
                $price          /// TotalAmount
            );

        } catch ( Exception $e )
        {
            return  redirect()->route('gateway_error');
        }
        if ( $token )
            return ['token'=>$token, 'resNum'=>$orderId];
        else
            return false;


    }

    public function saman_verify($State,$RefNum,$ResNum,$token)
    {
//        dd($State);
//        $settingRepository = new AdminSettingRepository();
//        $this->saman_MID = $this->settingRepository->get_str_value('saman_MID');

        if( $State== "OK") {
            $soapclient = new soapclient('https://verify.sep.ir/Payments/ReferencePayment.asmx?WSDL');
            $res 		= $soapclient->VerifyTransaction($RefNum, $this->saman_MID);

            if( $res <= 0 )
            {
//                $payment = Payment::where('resNum', $ResNum)->first();
//                Auth::loginUsingId($payment->order->user_id);
//                return redirect(\url($payment->call_back_route_name));
//                return redirect()->route();
//                if ($res==-1)
//                    return view('gateway::saman.canceledByUser');
                return 'redirect';
            } else {

                return ['ResNum'=>$ResNum,'RefNum'=>$RefNum,'token'=>$token];
            }
        } else {
            return 'redirect';
        }
    }

    public function randNumber(): int
    {
        $number = rand( 10000,99999 );
        if (Payment::where('resNum', $number)->first())
            return $this->randNumber();
        return $number;
    }
}

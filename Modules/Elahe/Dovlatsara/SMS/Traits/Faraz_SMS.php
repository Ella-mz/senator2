<?php


namespace Modules\SMS\Traits;


use Illuminate\Support\Facades\Http;
//use Modules\Setting\Repositores\SettingRepository;

trait Faraz_SMS
{
    private $settingRepository;
    private $internal_username;
    private $internal_password;
    private $international_faraz_sender;
    private $international_faraz_code;

//    public function __construct(SettingRepository $settingRepository)
//    {
//        $this->settingRepository = $settingRepository;
//        $this->internal_username = $this->settingRepository->get_str_value('usernameFarazSMSCode');
//        $this->internal_password = $this->settingRepository->get_str_value('passwordFarazSMSCode');
//        $this->international_faraz_code = $this->settingRepository->get_str_value('InternationalFarazSMSCode');
//        $this->international_faraz_sender = $this->settingRepository->get_str_value('InternationalFarazSMSSender');
//
//    }

    public function index_faraz($mobile,$message)
    {
        $mobile=$this->convert_to_international($mobile);
        if(substr($mobile,0,2)=="00")
            $this->send_international($mobile,$message);
        else
            $this->send_internal($mobile,$message);

        return true;
    }

    public function send_international($mobile,$message)
    {
        $code=$this->international_faraz_code;
        $sender=$this->international_faraz_sender;

        $response = Http::get('https://api.kavenegar.com/V1/'.$code.'/sms/send.json', [
            'receptor'=>urlencode($mobile),
            'message'=>urlencode($message),
            'sender'=>$sender
        ]);
        return $response->status();
     }
    public function send_internal($mobile,$message)
    {
        $url = "https://ippanel.com/services.jspd";
        $param = array
        (
            'uname'=>$this->internal_username,
            'pass'=>$this->internal_password,
            'from'=>'+983000505',
            'message'=>$message,
            'to'=>json_encode([$mobile]),
            'op'=>'send'
        );

//        $handler = curl_init($url);
//        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($handler, CURLOPT_POSTFIELDS, $param);
//        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
//        $response2 = curl_exec($handler);
//        $response2 = json_decode($response2);
//        $res_code = $response2[0];
//        $res_data = $response2[1];

    }
    public function index_pattern_faraz($mobile,$internationalPattern,$token,$pattern,$user=null)
    {
        $mobile=$this->convertToInternational($mobile);
        if(substr($mobile,0,2)=="00") {

            $this->send_international_pattern($mobile,$token,$internationalPattern);
        }
        else{
            $this->send_internal_pattern($mobile,$pattern,$user,$token);
        }
        return true;
    }

    public function send_international_pattern($mobile,$token,$internationalPattern)
    {
        $code=$this->international_faraz_code;
        $response = Http::get('https://api.kavenegar.com/V1/'.$code.'/verify/lookup.json', [

            'receptor' => urlencode($mobile),
            'token' => urlencode($token),
            'template' => urlencode($internationalPattern),

        ]);
        return $response->status();

    }
    public function send_internal_pattern($mobile,$patern,$user,$token)
    {
        $input_data_array=$user==null?array("token" => $token):array("token" => $token,"user"=>$user);
        $username= $this->internal_username;
        $password=$this->internal_password;
        $from = "+983000505";
        $pattern_code = $patern;
        $to = [$mobile];
        $input_data = $input_data_array ;
        $url = "https://ippanel.com/patterns/pattern?username=" . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$pattern_code";
//        $handler = curl_init($url);
//        curl_setopt($handler, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($handler, CURLOPT_POSTFIELDS, $input_data);
//        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
//        $response = curl_exec($handler);
//        return $response;
    }


    public function convert_to_international($mobile)
    {
        return $mobile;
    }
}

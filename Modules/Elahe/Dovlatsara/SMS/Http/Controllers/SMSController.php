<?php

namespace Modules\SMS\Http\Controllers;

use Illuminate\Routing\Controller;
//use Modules\Setting\Repositores\SettingRepository;
use Modules\SMS\Traits\Faraz_SMS;
use Modules\SMS\Traits\SMSIR;

class SMSController extends Controller
{
    use Faraz_SMS;
    use SMSIR;

//    private $settingRepository;

//    public function __construct(SettingRepository $settingRepository)
//    {
//        $this->settingRepository = $settingRepository;
//    }

    public function send_sms($mobile,$message)
    {
//        $sms_service = $this->settingRepository->get_str_value('sms_service');
        $sms_service = 'SMS.IR';
        switch ($sms_service) {
            case 'SMS.IR':
                $this->index_sms_ir();
                break;
            case 'FARAZ_SMS':
                $this->index_faraz($mobile,$message);
                break;
        }
    }
    public function send_sms_with_pattern($mobile,$internationalPattern,$token,$pattern ,$user, $param)
    {
//        $sms_service = $this->settingRepository->get_str_value('sms_service');
        $sms_service = 'SMS.IR';

        switch ($sms_service) {
            case 'SMS.IR':
                $this->index_pattern_sms_ir($token, $pattern, $mobile, $param);
                break;
            case 'FARAZ_SMS':
                $this->index_pattern_faraz($mobile,$internationalPattern,$token,$pattern,$user=null);
                break;
        }
    }
}

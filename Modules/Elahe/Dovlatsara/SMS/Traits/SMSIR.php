<?php


namespace Modules\SMS\Traits;


use Ipecompany\Smsirlaravel\Smsirlaravel;

trait SMSIR
{
    public function index_sms_ir()
    {

    }
    public function index_pattern_sms_ir($token,$pattern ,$mobile, $param)
    {
        return   Smsirlaravel::ultraFastSend([$param => $token], $pattern,$mobile);

    }
//    public function index_pattern_sms_ir_username($token,$pattern ,$mobile)
//    {
////        return   Smsirlaravel::ultraFastSend(['username' => $token], $pattern,$mobile);
//
//    }

}

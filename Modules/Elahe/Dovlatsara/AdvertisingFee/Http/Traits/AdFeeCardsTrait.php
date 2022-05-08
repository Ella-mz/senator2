<?php namespace Modules\AdvertisingFee\Http\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Ad\Entities\Ad;
use Modules\AdImage\Entities\AdImage;
use Modules\AdminMaster\Http\Traits\UploadFileTrait;
use Modules\Attribute\Entities\Attribute;
use Modules\Setting\Entities\Setting;

trait AdFeeCardsTrait
{

    public function freeCard()
    {
        $content = '';
//        $content .= '<div class="row"><div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px">';
//        $content .= '';
//        $content .= '</div></div></div>';
        return $content;
    }
    public function memshipCard()
    {
//        if ($type=='general'){
            $content = '';
            $content .= '<div class="row"><div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
            $content .= 'هزینه آگهی شما با حق اشتراک خریداری شده پرداخت می شود. <br>';
//            $content .= '';
//            $content .= $mem_user->allowedNumberOfGeneralAds;
//            $content .= '<input hidden name="memeShip" value="' . $mem_user->id . '">';
            $content .= '</div></div></div>';
//        }elseif ($type=='scalar'){
//            $content = '';
//            $content .= '<div class="row"><div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
//            $content .= 'It will pay by your membership credit. <br>';
//            $content .= ' Your remain credit: ';
//            $content .= $mem_user->allowedNumberOfScalarAds;
//            $content .= '<input hidden name="memeShip" value="' . $mem_user->id . '">';
//            $content .= '</div></div></div>';
//        }elseif($type==3){
//            $content = '';
//            $content .= '<div class="row"><div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
//            $content .= 'It will pay by your membership credit. <br>';
//            $content .= ' Your remain credit: ';
//            $content .= $mem_user->allowedNumberOfSpecialAds;
//            $content .= '<input hidden name="memeShip" value="' . $mem_user->id . '">';
//            $content .= '</div></div></div>';
//        }
        return $content;
    }

    public function adFeeCard($type, $adFee)
    {
        if ($type=='general'){
            $content='';
            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
            $content .= 'هزینه ثبت آگهی: ';
            $content .= $adFee->generalAdFee . '<br>';
            $content .= 'مدت اعتبار آگهی: ';
            $content .= $adFee->expireDateOfAds . 'روز';
            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
            $content .= '</div></div>';
        }elseif ($type=='scalar'){
            $content='';
            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
            $content .= 'هزینه ثبت آگهی: ';
            $content .= $adFee->scalarAdFee . '<br>';
            $content .= 'مدت اعتبار آگهی: ';
            $content .= $adFee->expireDateOfAds . 'روز';
            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
            $content .= '</div></div>';
        }elseif($type=='special'){
            $content='';
            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
            $content .= 'هزینه ثبت آگهی: ';
            $content .= $adFee->specialAdFee . '<br>';
            $content .= 'مدت اعتبار آگهی: ';
            $content .= $adFee->expireDateOfAds . 'روز';
            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
            $content .= '</div></div>';
        }elseif($type=='emergency'){
            $content='';
            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
            $content .= 'هزینه ثبت آگهی: ';
            $content .= $adFee->emergencyAdFee . '<br>';
            $content .= 'مدت اعتبار آگهی: ';
            $content .= $adFee->expireDateOfAds . 'روز';
            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
            $content .= '</div></div>';
        }
        return $content;
    }

}

<?php namespace Modules\AdFee\Http\Traits;

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

    public function adFeeCard($type, $adFee, $key)
    {
        if ($type == 'general') {
            $content = '';
            $content .= '<li><div class="radio-box">';
//            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 mb-3" >';

            if ($key == 0) {
                $content .= '<input type="radio" checked id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
//                $content .= '<div class="account-box"><input checked type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
            } else {
                $content .= '<input type="radio" id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
//                $content .= '<div class="account-box"><input type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
            }
            $content .= '<label >آگهی عادی:</label><br></div><p class="price-package-day">' . $adFee->expireTimeOfAds . ' روز</p>';
            $content .= '<p class="price-package-price">' . number_format($adFee->generalAdFee) . ' ریال</p></li>';
//            $content .= '<label for="html" class="account-name">هزینه ی ثبت آگهی</label><br>';
//            $content .= '<div class="price-box d-flex justify-content-between align-items-center mt-3"><p class="duration">';
//            $content .= $adFee->expireTimeOfAds . ' روز </p>';
//            $content .= '<p class="price">' . number_format($adFee->generalAdFee) . ' ریال </p></div></div></div>';
//            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
//            $content .= 'هزینه ثبت آگهی: ';
//            $content .= number_format($adFee->generalAdFee) . '<br>';
//            $content .= 'مدت اعتبار آگهی: ';
//            $content .= $adFee->expireTimeOfAds . 'روز';
//            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
//            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
//            $content .= '</div></div>';
        } elseif ($type == 'scalar') {
            $content = '';
            $content .= '<li><div class="radio-box">';
            if ($key == 0) {
                $content .= '<input type="radio" checked id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
            } else {
                $content .= '<input type="radio" id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
            }
            $content .= '<label >آگهی نردبانی:</label><br></div><p class="price-package-day">' . $adFee->expireTimeOfAds . ' روز</p>';
            $content .= '<p class="price-package-price">' . number_format($adFee->scalarAdFee) . ' ریال</p></li>';

//            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 mb-3" >';
//
//            if ($key == 0) {
//                $content .= '<div class="account-box"><input checked type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//            } else {
//                $content .= '<div class="account-box"><input type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//            }
//            $content .= '<label for="html" class="account-name">هزینه ی ثبت آگهی</label><br>';
//            $content .= '<div class="price-box d-flex justify-content-between align-items-center mt-3"><p class="duration">';
//            $content .= $adFee->expireTimeOfAds . ' روز </p>';
//            $content .= '<p class="price">' . number_format($adFee->scalarAdFee) . ' ریال </p></div></div></div>';
//            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
//            $content .= 'هزینه ثبت آگهی: ';
//            $content .= number_format($adFee->scalarAdFee) . '<br>';
//            $content .= 'مدت اعتبار آگهی: ';
//            $content .= $adFee->expireTimeOfAds . 'روز';
//            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
//            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
//            $content .= '</div></div>';
        } elseif ($type == 'special') {

            $content = '';
            $content .= '<li><div class="radio-box">';
            if ($key == 0) {
                $content .= '<input type="radio" checked id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
            } else {
                $content .= '<input type="radio" id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
            }
            $content .= '<label >آگهی ویژه:</label><br></div><p class="price-package-day">' . $adFee->expireTimeOfAds . ' روز</p>';
            $content .= '<p class="price-package-price">' . number_format($adFee->specialAdFee) . ' ریال</p></li>';

//            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 mb-3" >';
//
//            if ($key == 0) {
//                $content .= '<div class="account-box"><input checked type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//
//            } else {
//                $content .= '<div class="account-box"><input type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//            }
//            $content .= '<label for="html" class="account-name">هزینه ی ثبت آگهی</label><br>';
//            $content .= '<div class="price-box d-flex justify-content-between align-items-center mt-3"><p class="duration">';
//            $content .= $adFee->expireTimeOfAds . ' روز </p>';
//            $content .= '<p class="price">' . number_format($adFee->specialAdFee) . ' ریال </p></div></div></div>';
//            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
//            $content .= 'هزینه ثبت آگهی: ';
//            $content .= number_format($adFee->specialAdFee) . '<br>';
//            $content .= 'مدت اعتبار آگهی: ';
//            $content .= $adFee->expireTimeOfAds . 'روز';
//            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
//            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
//            $content .= '</div></div>';
        } elseif ($type == 'emergency') {
            $content = '';
            $content .= '<li><div class="radio-box">';
            if ($key == 0) {
                $content .= '<input type="radio" checked id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
            } else {
                $content .= '<input type="radio" id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
            }
            $content .= '<label >آگهی فوری:</label><br></div><p class="price-package-day">' . $adFee->expireTimeOfAds . ' روز</p>';
            $content .= '<p class="price-package-price">' . number_format($adFee->emergencyAdFee) . ' ریال</p></li>';

//            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 mb-3" >';
//            if ($key == 0) {
//                $content .= '<div class="account-box"><input type="radio" checked name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//
//            } else {
//                $content .= '<div class="account-box"><input type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//            }
//            $content .= '<label for="html" class="account-name">هزینه ی ثبت آگهی</label><br>';
//            $content .= '<div class="price-box d-flex justify-content-between align-items-center mt-3"><p class="duration">';
//            $content .= $adFee->expireTimeOfAds . ' روز </p>';
//            $content .= '<p class="price">' . number_format($adFee->emergencyAdFee) . ' ریال </p></div></div></div>';
//            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
//            $content .= 'هزینه ثبت آگهی: ';
//            $content .= number_format($adFee->emergencyAdFee) . '<br>';
//            $content .= 'مدت اعتبار آگهی: ';
//            $content .= $adFee->expireTimeOfAds . 'روز';
//            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
//            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
//            $content .= '</div></div>';
        }
        return $content;
    }

    public function chosenAdFeeCard($type, $adFee, $key, $chosenAdFee)
    {
        if ($type == 'general') {
            $content = '';
            $content .= '<li><div class="radio-box">';

            if ($chosenAdFee->id == $adFee->id) {
                $content .= '<input type="radio" checked id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';

            } else {
//            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 mb-3" >';

//                $content .= '<div class="account-box"><input checked type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
                $content .= '<input type="radio" id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
//                $content .= '<div class="account-box"><input type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';


            }
            $content .= '<label >آگهی عادی:</label><br></div><p class="price-package-day">' . $adFee->expireTimeOfAds . ' روز</p>';
            $content .= '<p class="price-package-price">' . number_format($adFee->generalAdFee) . ' ریال</p></li>';

//            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 mb-3" >';
//            if ($chosenAdFee->id == $adFee->id) {
//                $content .= '<div class="account-box"><input checked type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//
//            } else {
//                $content .= '<div class="account-box"><input type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//            }
//            $content .= '<label for="html" class="account-name">هزینه ی ثبت آگهی</label><br>';
//            $content .= '<div class="price-box d-flex justify-content-between align-items-center mt-3"><p class="duration">';
//            $content .= $adFee->expireTimeOfAds . ' روز </p>';
//            $content .= '<p class="price">' . number_format($adFee->generalAdFee) . ' ریال </p></div></div></div>';
//            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
//            $content .= 'هزینه ثبت آگهی: ';
//            $content .= number_format($adFee->generalAdFee) . '<br>';
//            $content .= 'مدت اعتبار آگهی: ';
//            $content .= $adFee->expireTimeOfAds . 'روز';
//            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
//            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
//            $content .= '</div></div>';
        } elseif ($type == 'scalar') {
            $content = '';
            $content .= '<li><div class="radio-box">';
            if ($chosenAdFee->id == $adFee->id) {
                $content .= '<input type="radio" checked id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';

            } else {
//            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 mb-3" >';

//                $content .= '<div class="account-box"><input checked type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
                $content .= '<input type="radio" id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
//                $content .= '<div class="account-box"><input type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';


            }
            $content .= '<label >آگهی نردبانی:</label><br></div><p class="price-package-day">' . $adFee->expireTimeOfAds . ' روز</p>';
            $content .= '<p class="price-package-price">' . number_format($adFee->scalarAdFee) . ' ریال</p></li>';

//            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 mb-3" >';
//            if ($chosenAdFee->id == $adFee->id) {
//                $content .= '<div class="account-box"><input checked type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//            } else {
//                $content .= '<div class="account-box"><input type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//            }
//            $content .= '<label for="html" class="account-name">هزینه ی ثبت آگهی</label><br>';
//            $content .= '<div class="price-box d-flex justify-content-between align-items-center mt-3"><p class="duration">';
//            $content .= $adFee->expireTimeOfAds . ' روز </p>';
//            $content .= '<p class="price">' . number_format($adFee->scalarAdFee) . ' ریال </p></div></div></div>';
//            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
//            $content .= 'هزینه ثبت آگهی: ';
//            $content .= number_format($adFee->scalarAdFee) . '<br>';
//            $content .= 'مدت اعتبار آگهی: ';
//            $content .= $adFee->expireTimeOfAds . 'روز';
//            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
//            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
//            $content .= '</div></div>';
        } elseif ($type == 'special') {
            $content = '';
            $content .= '<li><div class="radio-box">';
            if ($chosenAdFee->id == $adFee->id) {
                $content .= '<input type="radio" checked id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';

            } else {
                $content .= '<input type="radio" id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
            }
            $content .= '<label >آگهی ویژه:</label><br></div><p class="price-package-day">' . $adFee->expireTimeOfAds . ' روز</p>';
            $content .= '<p class="price-package-price">' . number_format($adFee->specialAdFee) . ' ریال</p></li>';

//            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 mb-3" >';
//            if ($chosenAdFee->id == $adFee->id) {
//
//                $content .= '<div class="account-box"><input checked type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//
//            } else {
//                $content .= '<div class="account-box"><input type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//            }
//            $content .= '<label for="html" class="account-name">هزینه ی ثبت آگهی</label><br>';
//            $content .= '<div class="price-box d-flex justify-content-between align-items-center mt-3"><p class="duration">';
//            $content .= $adFee->expireTimeOfAds . ' روز </p>';
//            $content .= '<p class="price">' . number_format($adFee->specialAdFee) . ' ریال </p></div></div></div>';
//            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
//            $content .= 'هزینه ثبت آگهی: ';
//            $content .= number_format($adFee->specialAdFee) . '<br>';
//            $content .= 'مدت اعتبار آگهی: ';
//            $content .= $adFee->expireTimeOfAds . 'روز';
//            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
//            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
//            $content .= '</div></div>';
        } elseif ($type == 'emergency') {
            $content = '';
            $content = '';
            $content .= '<li><div class="radio-box">';
            if ($chosenAdFee->id == $adFee->id) {
                $content .= '<input type="radio" checked id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';

            } else {
                $content .= '<input type="radio" id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" value="' . $adFee->id . '">';
            }
            $content .= '<label >آگهی فوری:</label><br></div><p class="price-package-day">' . $adFee->expireTimeOfAds . ' روز</p>';
            $content .= '<p class="price-package-price">' . number_format($adFee->emergencyAdFee) . ' ریال</p></li>';

//            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 mb-3" >';
//            if ($chosenAdFee->id == $adFee->id) {
//                $content .= '<div class="account-box"><input type="radio" checked name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//
//            } else {
//                $content .= '<div class="account-box"><input type="radio" name="adPaymentFee" id="adPaymentFee[' . $adFee->id . ']" value="' . $adFee->id . '">';
//            }
//            $content .= '<label for="html" class="account-name">هزینه ی ثبت آگهی</label><br>';
//            $content .= '<div class="price-box d-flex justify-content-between align-items-center mt-3"><p class="duration">';
//            $content .= $adFee->expireTimeOfAds . ' روز </p>';
//            $content .= '<p class="price">' . number_format($adFee->emergencyAdFee) . ' ریال </p></div></div></div>';
//            $content .= '<div class="col-md-4 mt-5"><div class=" p-2" style="border: 1px #1256d4 solid; border-radius: 12px" >';
//            $content .= 'هزینه ثبت آگهی: ';
//            $content .= number_format($adFee->emergencyAdFee) . '<br>';
//            $content .= 'مدت اعتبار آگهی: ';
//            $content .= $adFee->expireTimeOfAds . 'روز';
//            $content .= '<div class="d-flex justify-content-end align-content-end ml-2">';
//            $content .= '<input id="adPaymentFee[' . $adFee->id . ']" name="adPaymentFee" type="radio" value="' . $adFee->id . '" class="checkbox-inline"></div>';
//            $content .= '</div></div>';
        }
        return $content;
    }

}

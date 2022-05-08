<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Modules\Category\Entities\Category;
use SoapClient;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkGateway()
    {
        $array = [
            'price' => '100000',
        ];
        $price = $array['price'];
//        $callbackUrl = $this->saman_callbackurl;
        $MID = '12621704';
        $orderId = rand(10000, 99999);
        $client = new SoapClient('https://sep.shaparak.ir/payments/initpayment.asmx?wsdl');
//        dd($client);
        try {
            $token = $client->RequestToken(
                $MID,           /// MID
                $orderId,       /// ResNum
                $price          /// TotalAmount
            );

        } catch (Exception $e) {
            return redirect()->route('gateway_error');
        }
//        dd($token);
        if ($token)
            return view('gateway::saman.index', ['merchant_id' => $MID, 'call_back_url' => 'https://www.dolatsara.com/test/callbackurl']);

//        return $token;
//        $result = app('Modules\Gateway\Http\Controllers\GatewayController')
//            ->index($array);
//        dd($result);
//        if (!$result)
//            return redirect(\route(''));
    }

    public function convertToEnglish($string)
    {
        if ($string != null) {
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
            return str_replace($persian, $newNumbers, $string);
        } else
            return null;
    }

    public function getAllLastNode()
    {
        $categories = Category::all();
        $nodes = [];
        foreach ($categories as $key => $category) {
            if (!Category::where('parent_id', $category->id)->first())
                $nodes[$key] = $category->id;
        }
        return $nodes;
    }

    public function getLastNodewithItself($category)
    {
        $nodes = $this->getAllLastNode();
        $nodes = Category::whereIn('id', $nodes)->where('active', 1)->get();
        $childArray = [];
        foreach ($nodes as $key => $node) {
            if ($node->path != null) {
                $parents = explode(',', $node->path);
                if (in_array($category->id, $parents))
                    $childArray[$key] = $node->id;
            } else {
                if (($category->id == $node->id))
                    $childArray[$key] = $node->id;
            }
        }
        array_push($childArray, $category->id);
        return $childArray;
    }

}

<?php

namespace Modules\Payment\Repositories;

use Modules\Payment\Entities\Payment;

class PaymentRepository
{

    public function create($request, $order, $result, $gateway, $merchant_code, $start_gateway_page, $call_back_route_name)
    {
        $walletFee = 0;
        $paymentFee = $order->price;

        if (isset($request->iswallet) && isset($request->wallet_value)){
            if ($request->wallet_value>$order->price) {
                $paymentFee = 0;
                $walletFee = $order->price;
            }elseif($request->wallet_value<=$order->price){
                $paymentFee = $order->price - $request->wallet_value;
                $walletFee = $request->wallet_value;
            }
        }else{
            $paymentFee = $order->price;
            $walletFee = 0;
        }
        return Payment::create([
            'order_id' => $order->id,
            'price' => $order->price,
            'status' => 'unpaid',
            'gateway' => $gateway,
            'merchant_code' => $merchant_code,
            'start_gateway_page' => $start_gateway_page,
            'call_back_route_name' => $call_back_route_name,
            'token' => $result['merchant_code'],
            'resNum' => $result['resNum'],
            'wallet_fee' => $walletFee,
            'payment_fee' => $paymentFee
        ]);
    }
}

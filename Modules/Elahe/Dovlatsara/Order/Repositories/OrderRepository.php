<?php

namespace Modules\Order\Repositories;

use Modules\Ad\Entities\Ad;
use Modules\AdFee\Entities\AdFee;
use Modules\Advertising\Entities\Advertising;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\ApplicantMembership\Entities\ApplicantMembership;
use Modules\HologramInterface\Entities\HologramInterface;
use Modules\Membership\Entities\Membership;
use Modules\Order\Entities\Order;

class OrderRepository
{
    public function findOrderById($id)
    {
        return Order::find($id);
    }

    public function create($request, $type)
    {
        if ($type=='membership')
            $price = Membership::find($request->id)->price;
        elseif ($type=='advertisement')
            $price = AdvertisingApplication::find($request->id)->advertising->price;
        elseif ($type=='applicantMembership')
            $price = ApplicantMembership::find($request->id)->price;
        elseif ($type=='hologram')
            $price = HologramInterface::find($request->id)->hologram_price;
        elseif ($type=='ad')
        {
            $adFee = AdFee::find($request->adFeeId);
            $ad = Ad::find($request->id);
            if ($ad->type=='general')
                $price = $adFee->generalAdFee;
            elseif ($ad->type=='scalar')
                $price = $adFee->scalarAdFee;
            elseif ($ad->type=='special')
                $price = $adFee->specialAdFee;
            else
                $price = $adFee->emergencyAdFee;
        }
        return Order::create([
            'user_id'=>\auth()->id(),
            'type'=>$type,
            'type_id'=> $request->id,
            'price'=>$price,
            'status'=>'unpaid',
        ]);
    }
}

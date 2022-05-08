<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Order\Entities\Order;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = ['order_id', 'price', 'status', 'gateway', 'merchant_code', 'date', 'token',
        'created_user', 'updated_user', 'deleted_user', 'start_gateway_page', 'call_back_route_name', 'resNum',
        'refId', 'payment_fee', 'wallet_fee'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id')->withTrashed();
    }

    static $gatewayType =
        [
            'saman',
            'mellat',
            'zarinpal',
        ];
    static $statusType =
        [
            'paid',
            'unpaid',
        ];
}

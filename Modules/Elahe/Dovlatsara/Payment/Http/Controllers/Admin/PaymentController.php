<?php

namespace Modules\Payment\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Order\Entities\Order;
use Modules\Payment\Entities\Payment;
use Modules\User\Entities\User;

class PaymentController extends Controller
{

    /**
     *
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $type)
    {
        $validator = Validator::make($request->all(), [
            'resNum' => 'nullable|numeric',
            'mobile' => 'nullable|numeric'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $orderIdArray = [];
        $tags=[];
        foreach (Order::where('type', $type)->where('status', 'paid')->get() as $order){
           array_push($orderIdArray, $order->id);
        }
        $payments = Payment::whereIn('order_id', $orderIdArray);
        if (isset($request->mobile)||isset($request->resNum)){
            if (isset($request->mobile)){
                $tag = $request->mobile;
                $tags['mobile'] = 'موبایل کاربر: '.$tag;

                $userIdArray=[];
                foreach ($payments->get() as $payment){
                    array_push($userIdArray, $payment->order->user_id);
                }
                $orderIdArray2=[];
                $userIds = User::whereIn('id', $userIdArray)->where('mobile', 'LIKE', '%' . $tag . '%')->pluck('id')->toArray();
                foreach (Order::where('type', $type)->where('status', 'paid')->whereIn('user_id', $userIds)->get() as $order){
                    array_push($orderIdArray2, $order->id);
                }
                $payments = Payment::whereIn('order_id', $orderIdArray2);
            }
            if (isset($request->resNum)){
                $tag= $request->resNum;
                $tags['resNum'] = 'کد رهگیری: '.$tag;

                $payments = $payments->where('resNum', 'LIKE', '%' . $tag . '%');
            }
        }
        $payments = $payments->orderBydesc('created_at')->get();
        return view('Payments::admin.index', compact('payments', 'type', 'tags'));
    }

}

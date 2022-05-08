<?php
namespace Modules\CostumerClub\Repositories;

use Modules\CostumerClub\Entities\WalletTransaction;

class WalletTransactionRepository
{
    public function deactivate_decrease_create($price, $order_id=null, $user)
    {
        return WalletTransaction::create([
            'user_id'=>$user->id,
            'price'=>$price,
            'type'=>'decrease',
            'status'=>'deactivate',
            'order_id'=>$order_id,
            'created_user'=>$user->id,
        ]);
    }

    public function increase_create($price, $order_id=null)
    {
        return WalletTransaction::create([
            'user_id'=>auth()->id(),
            'price'=>$price,
            'type'=>'increase',
            'status'=>'active',
            'order_id'=>$order_id,
            'created_user'=>auth()->id(),
        ]);
    }

    public function decrease_create($price, $order_id=null)
    {
        return WalletTransaction::create([
            'user_id'=>auth()->id(),
            'price'=>$price,
            'type'=>'decrease',
            'status'=>'active',
            'order_id'=>$order_id,
            'created_user'=>auth()->id(),
        ]);
    }

    public function find_deactivate_transactions($order)
    {
        return WalletTransaction::where('status','deactivate')->where('order_id',$order->id)->get();
    }

    public function update($transaction,$array)
    {
        return $transaction->update($array);
    }
}

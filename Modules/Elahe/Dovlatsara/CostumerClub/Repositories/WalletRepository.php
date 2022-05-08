<?php


namespace Modules\CostumerClub\Repositories;



use Modules\CostumerClub\Entities\Wallet;

class WalletRepository
{
    public function find($user)
    {
        return Wallet::where('user_id', $user->id)->first();
    }
    public function create($user,$credit)
    {
        return Wallet::create([
            'user_id'=>$user->id,
            'wallet_balance'=>$credit,
            'created_user'=>auth()->id(),

        ]);
    }
    public function get_wallet_balance($user): int
    {
        $wallet = Wallet::where('user_id', $user->id)->first();
        return $wallet ? $wallet->wallet_balance : 0;
    }

    public function increase($credit)
    {
        $wallet = $this->find(auth()->user());
        if($wallet)
            return $wallet->update(['wallet_balance' => $wallet->wallet_balance + $credit]);
        else
            return  $this->create(auth()->user(),$credit);



    }
    public function decrease($credit)
    {
        $wallet=$this->find(auth()->user());
        if($wallet)
            return $wallet->update(['wallet_balance'=>$wallet->wallet_balance - $credit]);
    }
}

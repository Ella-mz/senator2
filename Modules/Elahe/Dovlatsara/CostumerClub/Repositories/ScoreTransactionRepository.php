<?php namespace Modules\CostumerClub\Repositories;

use Modules\CostumerClub\Entities\ScoreTransaction;

class ScoreTransactionRepository
{
    public function decrease_create($array)
    {
        return ScoreTransaction::create(array_merge($array, ['type' => 'decrease', 'created_user' => auth()->id()]));
    }

    public function increase_create($array)
    {
        return ScoreTransaction::create(array_merge($array, ['type' => 'increase', 'created_user' => auth()->id()]));
    }

    public function get_bonus_score()
    {
        $increase = ScoreTransaction::where('user_id', auth()->id())->where('type', 'increase')->sum('bonus');
        $decrease = ScoreTransaction::where('user_id', auth()->id())->where('type', 'decrease')->sum('bonus');
        return $increase - $decrease;
    }
}

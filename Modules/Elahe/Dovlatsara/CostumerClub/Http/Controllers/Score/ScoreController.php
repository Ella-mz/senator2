<?php

namespace Modules\CostumerClub\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use Modules\CostumerClub\Repositories\ScoreRepository;
use Modules\CostumerClub\Repositories\ScoreTransactionRepository;

class ScoreController extends Controller
{
    private $scoreTransactionRepository;
    private $scoreRepository;

    public function __construct(ScoreTransactionRepository $scoreTransactionRepository, ScoreRepository $scoreRepository)
    {
        $this->scoreTransactionRepository = $scoreTransactionRepository;
        $this->scoreRepository = $scoreRepository;
    }

    /**
     * @param $slug
     * @param $user_id
     * @param $description
     * @param int $point
     * @return bool
     */
    public function create_transaction_score($slug, $user_id, $description, $point = 1): bool
    {
        $score = $this->scoreRepository->find_with_slug($slug);
        if ($score->status == 'active')
            $this->scoreTransactionRepository->increase_create([
                'user_id' => $user_id,
                'score_id' => $score->id,
                'grant' => $score->grant * $point,
                'bonus' => $score->bonus * $point,
                'description' => $description,
            ]);
        return true;
    }
}

<?php namespace Modules\CostumerClub\Http\Controllers\Score\Panel;

use App\Http\Controllers\Controller;
use Modules\CostumerClub\Repositories\ScoreTransactionRepository;
use Modules\CostumerClub\Repositories\WalletRepository;
use Modules\CostumerClub\Repositories\WalletTransactionRepository;
use Modules\Setting\Repository\SettingRepository;

class ScoreController extends Controller
{
    private $walletRepository;
    private $scoreTransactionRepository;
    private $settingRepository;
    private $walletTransactionRepository;

    public function __construct(WalletRepository $walletRepository, ScoreTransactionRepository $scoreTransactionRepository,
                                SettingRepository $settingRepository, WalletTransactionRepository $walletTransactionRepository)
    {
        $this->walletRepository = $walletRepository;
        $this->scoreTransactionRepository = $scoreTransactionRepository;
        $this->settingRepository = $settingRepository;
        $this->walletTransactionRepository = $walletTransactionRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function score2wallet()
    {
        $current_balance = $this->walletRepository->get_wallet_balance(auth()->user());
        $current_bonus_scores = $this->scoreTransactionRepository->get_bonus_score();
        $score_exchange = $current_bonus_scores*($this->settingRepository->getSettingByTitle('coefficient_bonus_score')->str_value);
        return view('CostumerClubs::score.panel.scoreToWallet', compact('current_balance', 'current_bonus_scores', 'score_exchange'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function conversion_score_to_wallet_store(): \Illuminate\Http\RedirectResponse
    {
        $score=$this->scoreTransactionRepository->get_bonus_score();
        if($score>0)
        {
            $coefficient=$this->settingRepository->getSettingByTitle('coefficient_bonus_score')->str_value;
            $increase_wallet=$coefficient * $score;
            $this->walletTransactionRepository->increase_create($increase_wallet);
            $this->walletRepository->increase($increase_wallet);
            $this->scoreTransactionRepository->decrease_create([
                'user_id'=>auth()->id(),
                'bonus'=>$score,
                'description'=>'تبدیل امتیاز به کیف پول',
            ]);
            alert()->success('', 'کیف پول با موفقیت شارژ شد');
//            toast('کیف پول با موفقیت شارژ شد', 'success')->background('#e6ffe6')->timerProgressBar();
        }
        return redirect()->route('scores.score2wallet.panel');
    }
}

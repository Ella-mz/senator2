<?php

namespace Modules\CostumerClub\Http\Controllers\Score\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CostumerClub\Repositories\ScoreRepository;

class ScoreController extends Controller
{
    private $scoreRepository;
    public function __construct(ScoreRepository $scoreRepository)
    {
        $this->scoreRepository = $scoreRepository;
    }

    public function index()
    {
        $scores = $this->scoreRepository->all();
        return view('CostumerClubs::score.admin.index',compact('scores'));
    }

    public function edit($score_id)
    {
        $score= $this->scoreRepository->find_with_id($score_id);
        return view('CostumerClubs::score.admin.edit',compact('score'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $score= $this->scoreRepository->find_with_id($request->score_id);
        $score=$this->scoreRepository->update($score,$request->all());
        alert()->success('', 'ویرایش با موفقیت انجام شد.');
//        toast('ویرایش با موفقیت انجام شد','success')->background('#e6ffe6')->timerProgressBar();
        return redirect()->route('scores.index.admin');
    }
    public function change_score_status(Request $request)
    {
        $score= $this->scoreRepository->find_with_id($request->score_id);
        $score=$this->scoreRepository->update($score,['status'=>$request->status]);
        return response(true);
    }
}

<?php


namespace Modules\CommonQuestion\Http\Controllers\User;


use App\Http\Controllers\Controller;
use Modules\CommonQuestion\Repositories\CommonQuestionRepository;
use Illuminate\Http\Request;

class CommonQuestionController extends Controller
{
    public $repo;

    public function __construct(CommonQuestionRepository $commonQuestionRepository)
    {
        $this->repo = $commonQuestionRepository;
    }

    public function index()
    {
        $commonQuestions = $this->repo->commonQuestions();
        return view('CommonQuestions::user.index', compact('commonQuestions'));
    }

    public function search(Request $request)
    {
        $commonQuestions = $this->repo->searchInQuestions($request->search);
        return view('CommonQuestions::user.index', compact('commonQuestions'));
    }
}

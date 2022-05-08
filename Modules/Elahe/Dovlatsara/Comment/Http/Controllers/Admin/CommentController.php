<?php

namespace Modules\Comment\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Comment\Repositories\CommentRepository;
use Modules\CostumerClub\Http\Controllers\Score\ScoreController;

class CommentController extends Controller
{
    private $commentRepository;
    private $scoreController;

    public function __construct(CommentRepository $commentRepository, ScoreController $scoreController)
    {
        $this->commentRepository = $commentRepository;
        $this->scoreController = $scoreController;
    }

    public function index()
    {
        $comments = $this->commentRepository->get_comments_all();
        $comments->load('user');
        return view('Comments::admin.index', compact('comments'));
    }

    public function show($comment_id)
    {
        $comment = $this->commentRepository->find($comment_id);
        $comment->load('comments', 'user');
        return view('Comments::admin.show', compact('comment'));
    }

    public function change_status($comment_id, $status)
    {

        $comment = $this->commentRepository->find($comment_id);
        $this->commentRepository->update($comment, ['status' => $status]);

        if ($status == 'active' && !$comment->score) {
            $this->scoreController->create_transaction_score('create-article', $comment->create_user, 'کسب امتیاز به دلیل ثبت دیدگاه');
            $this->commentRepository->update($comment, ['score' => 1]);

        }
        toast('نظر با موفقیت در سایت منتشر شد', 'success')->background('#e6ffe6')->timerProgressBar();
        return redirect()->route('admin-comments-index');

    }
}

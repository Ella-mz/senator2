<?php

namespace Modules\Comment\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Comment\Http\Requests\General\CreateCommentRequest;
use Modules\Comment\Repositories\CommentRepository;

class CommentController extends Controller
{
    private $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository=$commentRepository;
    }
    public function add(CreateCommentRequest $request)
    {

    }
    public function add_ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment'=>'required|min:2'
        ]);
        if ($validator->fails()) {
            return response()->json(['result'=>0,'message'=>$validator->errors()->first()]);
        }
        $this->commentRepository->create($request);
        return response()->json(['result'=>1,'message'=>'دیدگاه شما با موفقیت ثبت شد!پس از تایید در سایت منتشر خواهد شد.']);
    }

    public function dislike($commentable_id)
    {
        $comment=$this->commentRepository->find($commentable_id);
        $comment=$this->commentRepository->update($comment,['dislike'=>$comment->dislike+1]);
        toast('با تشکر از مشارکت شما','success')->background('#e6ffe6')->timerProgressBar();
        return back();
    }
    public function like($commentable_id)
    {
        $comment=$this->commentRepository->find($commentable_id);
        $comment=$this->commentRepository->update($comment,['like'=>$comment->like+1]);
        toast('با تشکر از مشارکت شما','success')->background('#e6ffe6')->timerProgressBar();
        return back();
    }
}

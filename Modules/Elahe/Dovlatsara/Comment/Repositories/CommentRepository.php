<?php

namespace Modules\Comment\Repositories;

use Modules\Comment\Entities\Comment;

class CommentRepository
{
    public function create( $request)
    {

       Comment::create([
            'user_id'=>auth()->id(),
            'parent_id'=>$request->parent_id,
            'comment'=>$request->comment,
            'commentable_id'=>$request->commentable_id,
            'commentable_type'=>$request->commentable_type,
//            'status'=>,
            'create_user'=>auth()->id()
        ]);

    }

    public function find_with_type($commentable_type, $commentable_id)
    {
        return  Comment::where('commentable_type',$commentable_type)->where('commentable_id',$commentable_id)->first();

    }
    public function update($comment, $array)
    {
        return  $comment->update($array);
    }

    public function get_comments_level_1($object=null)
    {
        if(is_null($object))
        {
            return Comment::where('parent_id',0)->with('user','comments')->orderbyDesc('created_at')->get();
        }
        else
        {
            return Comment::where('status', 'active')
                ->where('commentable_type',get_class($object))->where('commentable_id',$object->id)
                ->where('parent_id',0)->with('user','comments')->orderbyDesc('created_at')->get();
        }
    }
    public function get_comments_all($object=null)
    {
        if(is_null($object))
        {
            return Comment::with('user','comments')->orderbyDesc('created_at')->get();
        }
        else
        {
            return Comment::active()
                ->where('commentable_type',get_class($object))->where('commentable_id',$object->id)
                ->with('user','comments')->orderbyDesc('created_at')->get();
        }
    }

    public function get_new_comments()
    {
        return Comment::where('status','waiting')->orderbyDesc('created_at')->get();

    }

    public function find($comment_id)
    {
        return  Comment::find($comment_id);

    }
}

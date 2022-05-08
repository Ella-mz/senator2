<?php namespace Modules\Comment\Traits;


use Modules\Comment\Entities\Comment;
use Modules\User\Entities\User;

trait CommentRelationsTrait
{
    public function commentable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'parent_id');
    }
    public function  comment()
    {
        return $this->belongsTo(Comment::class,'parent_id');
    }

}

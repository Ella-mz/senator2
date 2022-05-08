<?php namespace Modules\Blog\Traits;


use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleGroup;
use Modules\User\Entities\User;

trait PositionRelationsTrait
{
    public function group()
    {
        return $this->belongsTo(ArticleGroup::class, 'article_group_id');
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'create_user')->withTrashed();
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class,'article_position','position_id','article_id')->withPivot('order');
    }

}

<?php

namespace Modules\Comment\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Comment\Traits\CommentRelationsTrait;

class Comment extends Model
{
    use CommentRelationsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'parent_id',
        'comment',
        'commentable_id',
        'commentable_type',
        'like',
        'dislike',
        'status',
        'score',
        'create_user',
        'update_user',
        'delete_user',
    ];

    static $enumStatuses = [
        'active',
        'deactivate',
        'waiting'
    ];
}

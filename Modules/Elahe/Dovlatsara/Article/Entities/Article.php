<?php

namespace Modules\Article\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Entities\User;

class Article extends Model
{
//    use ArticleRelations;
    use SoftDeletes;

    use Sluggable;

    protected $fillable = [
        'title',
        'en_title',
        'slug',
        'article_group_id',
        'image',
        'video',
        'news',
        'shortDescription',
        'description',
        'view',
        'status',
        'create_user',
        'update_user',
        'deleted_user',
        'user_id',
        'agency_id',
        'check_approve_by_admin',
    ];
    static $enumStatuses = [
        'active',
        'deactivate',
    ];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'en_title'
            ]
        ];
    }

    public function group()
    {
        return $this->belongsTo(ArticleGroup::class, 'article_group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function agency()
    {
        return $this->belongsTo(User::class, 'agency_id')->withTrashed();
    }

    public function scopeStatus($query, $arg)
    {
        return $query->where('status', $arg);
    }

    public function ScopeAgencyId($query, $arg)
    {
        return $query->where('agency_id', $arg);
    }
}

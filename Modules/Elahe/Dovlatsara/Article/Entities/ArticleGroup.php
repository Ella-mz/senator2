<?php

namespace Modules\Article\Entities;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleGroup extends Model
{
    use Sluggable;
    use SoftDeletes;
//    use ArticleGroupRelations ;


    protected $fillable = [
        'title',
        'slug',
        'image',
        'create_user',
        'update_user',
        'deleted_user'
    ];
    static $enumStatuses = [
        'active',
        'deactivate',
    ];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'article_group_id');
    }
}

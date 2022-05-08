<?php

namespace Modules\Article\Repositories;

use Modules\Article\Entities\ArticleGroup;

class ArticleGroupRepository
{
    public function findArticleGroupBySlug($slug)
    {
        return ArticleGroup::where('slug', $slug)->first();
    }

    public function findArticleGroupById($id)
    {
        return ArticleGroup::find($id);
    }
    public function all()
    {
        return ArticleGroup::orderbyDesc('created_at')->get();
    }

    function create($request,$image)
    {
        return ArticleGroup::create([
            'title'=>$request->title,
            'image'=>$image,
            'created_user'=>auth()->id()
        ]);
    }

    function update( $articleGroup,$request,$image)
    {
        return $articleGroup->update([
            'title'=>$request->title,
            'image'=>$image

        ]);
    }

    public function delete( $articleGroup)
    {
        foreach ($articleGroup->articles as $article){
            $article->delete();
        }
        return $articleGroup->delete();
    }

    public static function get_active()
    {
        return ArticleGroup::whereHas('articles',function ($query)
        {
            return $query->where('status', 'active');
        })->orderbyDesc('title')->get();
    }

}

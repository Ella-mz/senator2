<?php

namespace Modules\Article\Repositories;

use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleGroup;
use Modules\User\Repositories\UserRepository;

class ArticleRepository
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findArticleById($id)
    {
        return Article::find($id);
    }

    public function findArticleBySlug($slug)
    {
        return Article::where('slug', $slug)->first();
    }

    public function all($slug)
    {
        $article_group = ArticleGroup::where('slug', $slug)->first();
        return Article::where('article_group_id', $article_group->id)->orderbyDesc('created_at')->get();
    }

    public function articlesFindByIds($ids)
    {
        return Article::whereIn('id', $ids)->orderbyDesc('created_at')->get();
    }
    public function articles()
    {
        return Article::orderbyDesc('created_at')->get();
    }

    public function articlesOfUser($userId)
    {
        return Article::where('user_id', $userId)->orderbyDesc('created_at')->get();
    }

    public function articlesOfUsers($userIds)
    {
        return Article::whereIn('user_id', $userIds)->orderbyDesc('created_at')->get();
    }

    public function allWithoutArticleGroup()
    {
        return Article::status('active')->orderbyDesc('created_at')->get();
    }

    public function allWithoutArticleGroupPaginate($paginate, $ids)
    {
        return Article::whereIn('id', $ids)->status('active')->orderbyDesc('created_at')->paginate($paginate);
    }

    public function delete($article)
    {
        $article->update([
            'deleted_user' => auth()->id(),
        ]);
        $article->delete();
    }

    function create($request, $image, $video, $articleGroup, $userId)
    {
        $user = $this->userRepository->userFindById($userId);
        if ($user->hasRole('real-state-agent'))
            $agencyId = $user->real_estate_admin_id;
        elseif ($user->hasRole('real-state-administrator'))
            $agencyId = $user->id;
        else
            $agencyId = null;
        return Article::create([
            'title' => $request->title,
            'en_title' => $request->en_title,
            'article_group_id' => $articleGroup->id,
            'image' => $image,
            'video' => $video,
            'news' => $request->news == "on" ? 1 : 0,
            'shortDescription' => $request->shortDescription,
            'description' => $request->description,
            'status' => 'deactivate',
            'created_user' => auth()->id(),
            'user_id'=> $userId,
            'agency_id'=> $agencyId

        ]);
    }

    function update($article, $request, $image, $video)
    {
        return $article->update([
            'title' => $request->title,
            'image' => $image,
            'shortDescription' => $request->shortDescription,
            'description' => $request->description,
            'video' => $video,
            'status' => 'deactivate',
            'en_title' => $request->en_title,
            'news' => $request->news == "on" ? 1 : 0,
            'updated_user' => auth()->id(),
        ]);
    }

    public function search($search)
    {
        return Article::where('title', 'like', '%' . $search . '%')
            ->status('active')->orderbyDesc('created_at')->get();

    }
    public function similarArticles($article)
    {
        return Article::where('article_group_id', $article->article_group_id)->where('id', '!=', $article->id)->get();
    }

    public function similarArticlesPaginate($article, $paginate)
    {
        return Article::where('article_group_id', $article->article_group_id)->where('id', '!=', $article->id)->paginate($paginate);
    }

    public function articlesOfAgency($agencyId)
    {
        return Article::agencyId($agencyId)->status('active')->orderByDesc('created_at')->get();
    }

    public function articlesOfAgencyForPanel($agencyId)
    {
        return Article::agencyId($agencyId)->orderByDesc('created_at')->get();
    }

    public function mostWantedArticles()
    {
        return Article::status('active')->orderBy('view', 'asc')->orderByDesc('created_at')->take(10)->get();

    }

    public function get_with_paginate( $request, $paginate)
    {
        $article_group_id=$request->article_group_id;
        $search=$request->search;

        return Article::
        when($article_group_id, function ($query) use($article_group_id){
            return $query->where('article_group_id',$article_group_id);
        })->
        when($search, function ($query) use($search){
            return $query->where('title' ,'like','%'.$search.'%');
        })->
        orderby('created_at', 'desc')->paginate($paginate);

    }

    public function get_similar($article)
    {
        return Article::where('article_group_id', $article->article_group_id)->where('status', 'active')->orderby('created_at', 'desc')->get()->take(6);
    }
}

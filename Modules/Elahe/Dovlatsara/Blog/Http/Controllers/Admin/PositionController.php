<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Blog\Repositories\PositionRepository;

class PositionController extends Controller
{

    private $articleRepository;
    private $positionRepository;

    public function __construct(ArticleRepository $articleRepository, PositionRepository $positionRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->positionRepository = $positionRepository;
    }

    public function index()
    {
        $positions = $this->positionRepository->all();
        $positions->load('articles');
        return view('Blogs::admin.index', compact('positions'));
    }

    public function edit($position_id)
    {
        $position = $this->positionRepository->find($position_id);
        return view('Blogs::admin.edit', compact('position'));
    }

    public function update(Request $request, $position_id)
    {
        $position = $this->positionRepository->find($position_id);
        $this->positionRepository->update($position, $request->all());
        toast(' ویرایش   با موفقیت انجام شد', 'success')->background('#e6ffe6')->timerProgressBar();
        return redirect()->route('position.index.admin');
    }

    public function articles($position_id)
    {
        $position = $this->positionRepository->find($position_id);
        $articles = $this->positionRepository->get_articles($position);
        return view('Blogs::admin.position-article', compact('position', 'articles'));

    }

    public function article_list(Request $request, $position_id)
    {
        $position = $this->positionRepository->find($position_id);
        $articles = $this->articleRepository->get_with_paginate($request, 20);
        return view('Blogs::admin.attach-article', compact('position', 'articles'));

    }

    public function attach_article(Request $request, $position_id)
    {
        if (!isset($request->articles))
            return back()->with('error_message', 'انتخاب مقالات الزامی است');
        $position = $this->positionRepository->find($position_id);
        $this->positionRepository->attach_article_array($position, $request->articles);
        toast(' ثبت  مقالات  با موفقیت انجام شد', 'success')->background('#e6ffe6')->timerProgressBar();
        return redirect()->route('admin-position-article',$position->id);
    }

    public function detach_article($position_id,$article_id)
    {
        $position = $this->positionRepository->find($position_id);
        $this->positionRepository->detach_article($position, $article_id);
        toast(' حذف  با موفقیت انجام شد', 'success')->background('#e6ffe6')->timerProgressBar();
        return redirect()->route('admin-position-article',$position->id);
    }
    public function change_order(Request $request)
    {
        $position = $this->positionRepository->find($request->position);
        $article = $this->articleRepository->findArticleById($request->article);

        $this->positionRepository->updatePivot($position,$article,['order' => $request->order]);
        return response(true);
    }
}

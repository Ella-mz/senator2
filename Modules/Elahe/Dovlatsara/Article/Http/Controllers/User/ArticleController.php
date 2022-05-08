<?php

namespace Modules\Article\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\AdminMasterNew\Http\Traits;
use Modules\Article\Repositories\ArticleGroupRepository;
use Modules\Article\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    use Traits\UploadFileTrait;

    private $articleRepository;
    private $articleGroupRepository;

    public function __construct(ArticleRepository $articleRepository, ArticleGroupRepository $articleGroupRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->articleGroupRepository = $articleGroupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
//        dd(auth()->id());
        $articles = $this->articleRepository->allWithoutArticleGroup();
        $article_groups = $this->articleGroupRepository->all();
        $group2 = null;
        $g=null;
        if (isset($request->group2)) {
            $articles = $articles->where('article_group_id', $request->group2);
            $group2 = $request->group2;
        }
        if (isset($request->weblog)){
            $g=$request->group;
            $articles = $articles->where('article_group_id', $request->group);
            return view('Articles::user.index', compact('articles', 'article_groups', 'group2', 'g'));
        }
        if (isset($request->search) || isset($request->group)) {
            if (isset($request->group)) {
                $articles = $articles->where('article_group_id', $request->group);
            }
            if (isset($request->search)) {
                $tag = $request->search;
                $articles = $articles->filter(function ($item) use ($tag) {
                    return strstr($item->title, $tag) ||
                        strstr($item->shortDescription, $tag) ||
                        strstr($item->description, $tag);
                });
            }
            $content = $this->articleCard($articles);
            return response()->json(['content' => $content]);
        }

        return view('Articles::user.index', compact('articles', 'article_groups', 'group2', 'g'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function show($slug)
    {
        $article = $this->articleRepository->findArticleBySlug($slug);
        $similar_articles = $this->articleRepository->similarArticles($article);
        $article->update([
            'view' => $article->view + 1,
        ]);
        return view('Articles::user.show', compact('article', 'similar_articles'));

    }

    public function articleCard($articles)
    {
        $content = '';
        foreach ($articles as $article) {
            $content .= '<div class="col-xl-3 col-lg-4 col-md-6 px-sm-3 mb-4"><div class="articleIntBox"><div class="imageBox">';
            $content .= '<img src="' . asset($article->image) . '" alt=""></div><div class="articleInfo"><div class="articleTitle">';
            $content .= '<h5>' . $article->title . '</h5></div><div class="articleText"><p>' . $article->shortDescription . '</p></div>';
            $content .= '<div class="readMore"><a href="' . route('articles.show.user', $article->slug) . '">بیشتر بخوانید</a>';
            $content .= '</div></div></div></div>';
        }
        return $content;
    }
}

<?php

namespace Modules\Article\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\AdminMasterNew\Http\Traits;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleGroup;
use Modules\Article\Repositories\ArticleGroupRepository;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Article\Transformers\ArticleCollection;
use Modules\Article\Transformers\ArticleGroupCollection;

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $articles = Article::where('status', 'active')->orderbyDesc('created_at');
        if (isset($request->groupId) || isset($request->search)) {
            if (isset($request->groupId)) {
                $articles = $articles->where('article_group_id', $request->groupId);
            }
            if (isset($request->search)) {
                $tag= $request->search;
                $articles = $articles->where(function ($query) use ($tag) {
                    $query->where('title', 'LIKE', '%' . $tag . '%');
                });
            }
        }
        $articleIds=[];
        foreach ($articles->get() as $article){
            array_push($articleIds, $article->id);

        }
        $articles = $this->articleRepository->allWithoutArticleGroupPaginate(10, $articleIds);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => new ArticleCollection($articles),
                'total' => $articles->total(),
                'path' => $articles->path(),
                'perPage' => $articles->perPage(),
                'currentPage' => $articles->currentPage(),
                'lastPage' => $articles->lastPage(),
            ],

        ], Response::HTTP_OK);
    }

    public function articleGroups()
    {
        $groups = ArticleGroup::where('status', 'active')->orderbyDesc('created_at')->get();
        return response()->json([
            'status_code' => 200,
            'data'=>new ArticleGroupCollection($groups)
        ], Response::HTTP_OK);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $article = $this->articleRepository->findArticleById($id);
        $article->update([
            'view'=>$article->view+1,
        ]);
        return response()->json([
            'status_code' => 200,
            'data' => new \Modules\Article\Transformers\Article($article),

        ], Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function similarArticles(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'articleId' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status_code' => 403,
            ], Response::HTTP_FORBIDDEN);
        }
        $article = $this->articleRepository->findArticleById($request->articleId);
        if(!$article)
            return response()->json([
                'data' => [],
                'errors' => ['آیدی مقاله اشتباه است'],
                'status_code' => 404,
            ], Response::HTTP_FORBIDDEN);
        $article = $this->articleRepository->findArticleById($request->articleId);
        $articles = $this->articleRepository->similarArticlesPaginate($article, 10);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => new ArticleCollection($articles),
                'total' => $articles->total(),
                'path' => $articles->path(),
                'perPage' => $articles->perPage(),
                'currentPage' => $articles->currentPage(),
                'lastPage' => $articles->lastPage(),
            ],

        ], Response::HTTP_OK);
    }
}

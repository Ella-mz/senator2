<?php

namespace Modules\Article\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Modules\AdminMasterNew\Http\Traits;
use Modules\Article\Repositories\ArticleGroupRepository;
use Modules\Article\Repositories\ArticleRepository;
use Modules\CostumerClub\Http\Controllers\Score\ScoreController;
use RealRashid\SweetAlert\Facades\Alert;

class ArticleController extends Controller
{
    use Traits\UploadFileTrait;

    private $articleRepository;
    private $articleGroupRepository;
    private $scoreController;

    public function __construct(ArticleRepository $articleRepository, ArticleGroupRepository $articleGroupRepository,
                                ScoreController $scoreController)
    {
        $this->articleRepository = $articleRepository;
        $this->articleGroupRepository = $articleGroupRepository;
        $this->scoreController = $scoreController;
    }

    /**
     * Display a listing of the resource.
     * @param $slug
     * @return Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function index($slug)
    {
        $articles = $this->articleRepository->all($slug);
        $articleGroup = $this->articleGroupRepository->findArticleGroupBySlug($slug);
        return view('Articles::admin.article.index', compact('articles', 'slug', 'articleGroup'));
    }

    /**
     * Display a listing of the resource.
     * @return Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function all(Request $request)
    {
        $tags = [];
        $articles = $this->articleRepository->articles();
        $articleGroups = $this->articleGroupRepository->all();
        if ($request->t == 1 && ((isset($request->status) || isset($request->group_article)))) {
            if (isset($request->status)) {
                $articles = $articles->where('status', $request->status);
                if ($request->status == 'active')
                    $tags['status'] = 'تایید شده';
                else
                    $tags['status'] = 'تایید نشده';
            }
            if (isset($request->group_article)) {
                $articles = $articles->where('article_group_id', $request->group_article);
                    $tags['group_article'] = $this->articleGroupRepository->findArticleGroupById($request->group_article)->title;
            }
            $article_ids = $articles->pluck('id')->toArray();
            $articles = $this->articleRepository->articlesFindByIds($article_ids);

            return view('Articles::admin.article.all', compact('articles', 'articleGroups', 'tags'));
        }
        return view('Articles::admin.article.all', compact('articles', 'articleGroups', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function create($slug)
    {
        $articleGroup = $this->articleGroupRepository->findArticleGroupBySlug($slug);
        return view('Articles::admin.article.create', compact('articleGroup'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'en_title' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'article_group_id' => 'required',
            'video' => 'mimes:mp4,ogx,oga,ogv,ogg,webm'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->file('image')) {
            $image = $this->uploadFile($request->file('image'), 'public/upload/' . $request->slug . '/article/image/' . now()->year
                . '/' . now()->month);
        } else
            $image = null;
        if ($request->file('video')) {
            $video = $this->uploadFile($request->file('video'), 'public/upload/' . $request->slug . '/article/video/' . now()->year
                . '/' . now()->month);
        } else
            $video = null;
        $articleGroup = $this->articleGroupRepository->findArticleGroupById($request->article_group_id);

        $article = $this->articleRepository->create($request, $image ?? null, $video ?? null, $articleGroup, auth()->id());
        $article->update(['status' => 'active']);
        Alert::success('', 'مقاله با موفقیت ثبت شد');
        return redirect()->route('articles.index.admin', $articleGroup->slug);
    }

    /**
     * Show the form for editing the specified resource.
     * @param $articleId
     * @return Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function edit($articleId)
    {
        $article = $this->articleRepository->findArticleById($articleId);
        return view('Articles::admin.article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $articleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $articleId): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'mimes:png,jpg,jpeg',
            'video' => 'mimes:mp4,ogx,oga,ogv,ogg,webm'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $article = $this->articleRepository->findArticleById($articleId);
        if ($request->file('image')) {
            File::delete(public_path($article->image));
            $image = $this->uploadFile($request->file('image'), 'public/upload/' . $article->group->slug . '/article/image/' . now()->year
                . '/' . now()->month);
        }
        if ($request->file('video')) {
            File::delete(public_path($article->video));
            $video = $this->uploadFile($request->file('video'), 'public/upload/' . $article->group->slug . '/article/video/' . now()->year
                . '/' . now()->month);
        }
        $this->articleRepository->update($article, $request, $image ?? $article->image, $video ?? $article->video);
        Alert::success('', 'مقالات با موفقیت ویرایش شد');
        return redirect()->route('articles.index.admin', $article->group->slug);
    }

    /**
     * Remove the specified resource from storage.
     * @param $articleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($articleId): \Illuminate\Http\RedirectResponse
    {
        $article = $this->articleRepository->findArticleById($articleId);
        $slug = $article->group->slug;
        $this->articleRepository->delete($article);
        Alert::success('', 'مقالات با موفقیت حذف شد');
        return redirect()->route('articles.index.admin', $slug);
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function activeArticle(Request $request)
    {
        $article = $this->articleRepository->findArticleById($request->id);
        if ($article) {
            if ($article->check_approve_by_admin == 0 && $request->active == 'active') {
                $article->update([
                    'check_approve_by_admin' => 1,
                ]);
                $this->scoreController->create_transaction_score('create-article', $article->user_id, 'کسب امتیاز به دلیل ثبت مقاله');
            }
            $article->update([
                'status' => $request->active,
            ]);
            return json_encode(true);
        } else
            return json_encode(false);
    }
}

<?php

namespace Modules\Article\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Modules\AdminMasterNew\Http\Traits;
use Modules\Article\Repositories\ArticleGroupRepository;
use Modules\Article\Repositories\ArticleRepository;
use Modules\User\Entities\User;
use RealRashid\SweetAlert\Facades\Alert;

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
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()->hasRole('real-state-administrator'))
            $articles = $this->articleRepository->articlesOfAgencyForPanel(auth()->id());
        else
            $articles = $this->articleRepository->articlesOfUser(auth()->id());
        return view('Articles::panel.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function create()
    {
        $articleGroups = $this->articleGroupRepository->all();
        return view('Articles::panel.create', compact('articleGroups'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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

        $article = $this->articleRepository->create($request, $image ?? null, $video?? null, $articleGroup, auth()->id());
        Alert::success('', 'مقاله با موفقیت ثبت شد');
        return redirect()->route('articles.index.panel', auth()->id());
    }

    /**
     * Show the form for editing the specified resource.
     * @param $articleId
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($articleId)
    {
        $article = $this->articleRepository->findArticleById($articleId);
        $articleGroups = $this->articleGroupRepository->all();

        return view('Articles::panel.edit', compact('article', 'articleGroups'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $articleId
     * @return RedirectResponse
     */
    public function update(Request $request, $articleId): RedirectResponse
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
        return redirect()->route('articles.index.panel', auth()->id());
    }

    /**
     * Remove the specified resource from storage.
     * @param $articleId
     * @return RedirectResponse
     */
    public function destroy($articleId): RedirectResponse
    {
        $article = $this->articleRepository->findArticleById($articleId);
        $this->articleRepository->delete($article);
        Alert::success('', 'مقالات با موفقیت حذف شد');
        return redirect()->route('articles.index.panel', auth()->id());
    }
}

<?php

namespace Modules\Article\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Modules\AdminMasterNew\Http\Traits;
use Modules\Article\Repositories\ArticleGroupRepository;
use RealRashid\SweetAlert\Facades\Alert;

class ArticleGroupController extends Controller
{
    use Traits\UploadFileTrait;

    private $articleGroupRepository;

    public function __construct(ArticleGroupRepository $articleGroupRepository)
    {
        $this->articleGroupRepository = $articleGroupRepository;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function index()
    {
        $article_groups=$this->articleGroupRepository->all();
        return view('Articles::admin.articleGroup.index',compact('article_groups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('Articles::admin.articleGroup.create');

    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->file('image')) {
            $image = $this->uploadFile($request->file('image'), 'public/upload/article-group/image/' . now()->year
                . '/' . now()->month);
        }else
            $image = null;
        $article_groups=$this->articleGroupRepository->create($request,$image??null);
        Alert::success('', 'گروه مقالات با موفقیت ثبت شد');
//        toast(' ثبت  گروه مقالات با موفقیت انجام شد','success')->background('#e6ffe6')->timerProgressBar();
        return redirect()->route('article-groups.index.admin');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function edit($articleGroupId)
    {
        $articleGroup = $this->articleGroupRepository->findArticleGroupById($articleGroupId);
        return view('Articles::admin.articleGroup.edit',compact('articleGroup'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $articleGroupId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $articleGroup = $this->articleGroupRepository->findArticleGroupById($articleGroupId);
        if ($request->file('image')) {
            File::delete(public_path($articleGroup->image));
            $image = $this->uploadFile($request->file('image'), 'public/upload/article-group/image/' . now()->year
                . '/' . now()->month);
            $articleGroup->update([
                'image' => $image,
            ]);
        }
        $this->articleGroupRepository->update($articleGroup,$request,$image??$articleGroup->image);
        Alert::success('', 'گروه مقالات با موفقیت ویرایش شد');
//        toast(' ویرایش  گروه مقالات با موفقیت انجام شد','success')->background('#e6ffe6')->timerProgressBar();
        return redirect()->route('article-groups.index.admin');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($articleGroupId)
    {
        $articleGroup = $this->articleGroupRepository->findArticleGroupById($articleGroupId);
        $this->articleGroupRepository->delete($articleGroup);
        Alert::success('', 'گروه مقالات با موفقیت حذف شد');
//        toast(' حذف  گروه مقالات با موفقیت انجام شد','success')->background('#e6ffe6')->timerProgressBar();
        return redirect()->route('article-groups.index.admin');
    }
}

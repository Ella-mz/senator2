<?php

namespace Modules\Category\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\AdminMasterNew\Http\Traits;

class CategoryController extends Controller
{
    use Traits\UploadFileTrait;

    private $selectCategoryDepth1Count;
    private $selectCategoryDepth2Count;
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->selectCategoryDepth1Count = 7;
        $this->selectCategoryDepth2Count = 10;
    }

    public function showCats($parentId)
    {
        $categories = $this->categoryRepository->categoriesWithParentId($parentId);
        $category = $this->categoryRepository->categoryFindById($parentId);
        return view('Categories::admin.index',
            compact('categories', 'parentId', 'category'));
    }

    public function addCat($parentId)
    {
        $category = $parentId != 0 ? $this->categoryRepository->categoryFindById($parentId) : null;

        return view('Categories::admin.create', compact('category',
            'parentId'));
    }


    public function getPath($parentId)
    {
        if ($parentId == 0)
            $current_path = null;
        else {
            $parentPath = $this->categoryRepository->categoryFindById($parentId)->path;
            $current_path = is_null($parentPath) ? $parentId : $parentPath . ',' . $parentId;
        }
        return $current_path;
    }

    public function storeCat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
//        if (Category::where('id', $request->parentId2)->first()->ads->count()==0) {
        $lastCat = Category::orderBy('order', 'desc')->first();

        $c = Category::create(
            [
                'parent_id' => $request->parentId2,
                'title' => $request->title,
                'depth' => $request->parentId2 == 0 ? 1 : $this->categoryRepository->categoryFindById($request->parentId2)->depth + 1,
                'path' => $this->getPath($request->parentId2),
                'created_user' => \auth()->id(),
                'order' => $lastCat == null ? 1 : $lastCat->order + 1,
                'selected' => 0,
            ]);
        if ($request->selected && $request->selected == 'on' && Category::where('selected', 1)->get()->count() < $this->selectCategoryDepth1Count) {
            $c->update([
                'selected' => 1,
            ]);
        }
        if ($request->file('image')) {
            $image = $this->uploadFile($request->file('image'), 'public/upload/category/image/' . now()->year
                . '/' . now()->month);
            $c->update(['image' => $image,]);
        }

//        }else{
//            Alert::error('امکان ایجاد دسته بندی نیست.', 'دسته بندی '.Category::where('id', $request->parentId2)->first()->title.' دارای آگهی است');
//            return redirect()->back();
//        }
        if ($request->parentId2 != 0) {
            if ($this->categoryRepository->categoryFindById($request->parentId2)) {
                if ($this->categoryRepository->categoryFindById($request->parentId2)->node == 1) {
                    $this->categoryRepository->categoryFindById($request->parentId2)->update(['node' => 0]);
                }
            }
        }
        Alert::success('', 'دسته بندی با موفقیت ثبت شد');
        return redirect()->route('category.index.admin', $request->parentId2);
    }

    public function editCat($cat)
    {
        $category = $this->categoryRepository->categoryFindById($cat);
        return view('Categories::admin.edit', compact('category'));

    }

    public function updateCat(Request $request, Category $category): \Illuminate\Http\RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->file('image')) {
            File::delete(public_path($category->image));
            $image = $this->uploadFile($request->file('image'), 'public/upload/category/image/' . now()->year
                . '/' . now()->month);
            $category->update([
                'image' => $image,
            ]);
        }
        $category->update(
            [
                'title' => $request->title,
                'selected' => 0,
                'updated_user' => \auth()->id(),
            ]
        );
        if ($request->selected && $request->selected == 'on' &&
            Category::where('selected', 1)->get()->count() < $this->selectCategoryDepth1Count) {
            $category->update([
                'selected' => 1,
            ]);
        }

        Alert::success(' ', 'دسته بندی با موفقیت ویرایش شد');
        return redirect()->route('category.index.admin', $category->parent_id);
    }

    public function getAllLastNode()
    {
        $categories = $this->categoryRepository->all();
        $nodes = [];
        foreach ($categories as $key => $category) {
            if (!Category::where('parent_id', $category->id)->first())
                $nodes[$key] = $category->id;
        }
        return $nodes;
    }

    public function getLastNode($category)
    {
        $nodes = $this->getAllLastNode();
        $nodes = Category::whereIn('id', $nodes)->get();
        $childArray = [];
        foreach ($nodes as $key => $node) {
//            $parents = explode(',', $node->path);
//
//            if (in_array($category->id, $parents))
//                $childArray[$key] = $node->id;
            if ($node->path != null) {
                $parents = explode(',', $node->path);

                if (in_array($category->id, $parents))
                    $childArray[$key] = $node->id;
            } else {
                if (($category->id == $node->id))
                    $childArray[$key] = $node->id;
            }
        }
        return $childArray;
    }

    public function destroyCat($cat)
    {
        $category = $this->categoryRepository->categoryFindById($cat);

        if ($category->node == 1) {
            if ($category->ads()->count() <= 0 && $category->applications()->count() <= 0) {
                foreach ($category->adFees()->get() as $adFee) {
                    $adFee->delete();
                }
                if (isset($category->image))
                    File::delete(public_path($category->image));
                $parent_cat =$category->category;
                if ($parent_cat && $parent_cat->subCategories()->count()<=1){
                    $parent_cat->update([
                       'node'=>1,
                    ]);
                }
                $category->delete();
                Alert::success(' ', 'دسته بندی با موفقیت حذف شد');
                return redirect()->back();
            } else {
                if ($category->ads()->count() == 0)
                    Alert::error('امکان حذف نیست', 'این داسته بندی دارای درخواست های وابسته است.');
                elseif ($category->applications()->count() == 0)
                    Alert::error('امکان حذف نیست', 'این داسته بندی دارای آگهی های وابسته است.');
                else
                    Alert::error('امکان حذف نیست', 'این داسته بندی دارای آگهی و درخواست های وابسته است.');
                return redirect()->back();
            }
        } else {
            Alert::error('امکان حذف نیست', 'دسته بندی انتخاب شده داری زیرمجموعه است.');
            return redirect()->back();
        }
//        if ($category->node == 1) {
//            if ($category->ads()->count() == 0) {
//                foreach ($category->adFees()->get() as $adFee) {
//                    $adFee->delete();
//                }
//                if ($category->parent_id != 0) {
//                    if ($category->category->subCategories->count() > 1) {
//                        foreach ($category->applications as $application) {
//                            $application->delete();
//                        }
//                        if (isset($category->image))
//                            File::delete(public_path($category->image));
//                        $category->delete();
//                        Alert::success(' ', 'دسته بندی با موفقیت حذف شد');
//                        return redirect()->back();
//                    } else {
//                        $cc = Category::where('id', $category->category->id)->first();
//                        $cc->update([
//                            'node' => 1,
//                        ]);
//                        File::delete(public_path($category->image));
//                        $category->delete();
//                        Alert::success(' ', 'دسته بندی با موفقیت حذف شد');
//                        return redirect()->back();
//                    }
//                } else {
//                    foreach ($category->applications as $application) {
//                        $application->delete();
//                    }
//                    if (isset($category->image))
//                        File::delete(public_path($category->image));
//                    $category->delete();
//                    Alert::success(' ', 'دسته بندی با موفقیت حذف شد');
//                    return redirect()->back();
//                }
//            } else {
//                Alert::error('قابل حذف نیست', 'دسته بندی دارای آگهی است.');
//                return redirect()->back();
//            }
//        } else {
//            $check = [];
//            $childArray = $this->getLastNode($category);
//
//            foreach (Category::whereIn('id', $childArray)->get() as $cat) {
//                if ($cat->ads()->count() == 0) {
//                    $check[$cat->id] = 0;
//
//                } else {
//                    $check[$cat->id] = 1;
//                    Alert::error('قابل حذف نیست', 'زیر مجموعه این دسته بندی دارای آگهی است.');
//                    return redirect()->back();
//                }
//                if (!array_search(1, $check)) {
//
//                    foreach (Category::whereIn('id', $childArray)->get() as $cat) {
//                        // if ($cat->ads()->count() == 0) {
//                        foreach ($cat->ads()->get() as $ad) {
//                            $ad->delete();
//                        }
//                        foreach ($cat->adFees()->get() as $adFee) {
//                            $adFee->delete();
//                        }
//                        if ($category->parent_id != 0) {
//                            if ($category->category->subCategories->count() > 1) {
//                                foreach ($category->applications as $application) {
//                                    $application->delete();
//                                }
//                                if (isset($cat->image))
//                                    File::delete(public_path($cat->image));
//                                $cat->delete();
//                                Alert::success(' ', 'دسته بندی با موفقیت حذف شد');
//                                return redirect()->back();
//                            } else {
//                                $cc = Category::where('id', $category->category->id)->first();
//                                $cc->update([
//                                    'node' => 1,
//                                ]);
//                                foreach ($category->applications as $application) {
//                                    $application->delete();
//                                }
//                                if (isset($category->image))
//                                    File::delete(public_path($category->image));
//                                $category->delete();
//                                Alert::success(' ', 'دسته بندی با موفقیت حذف شد');
//                                return redirect()->back();
//                            }
//                        } else {
//                            if ($category->subCategories->count() > 0) {
//                                foreach ($category->subCategories as $cate) {
//                                    $cate->delete();
//                                }
//                            }
//                            if (isset($category->image))
//                                File::delete(public_path($category->image));
//                            $category->delete();
//                            Alert::success(' ', 'دسته بندی با موفقیت حذف شد');
//                            return redirect()->back();
//                        }
//                        //}
//                    }
//                }
//
//            }
//        }
    }

    public function deleteFile(Request $request): JsonResponse
    {
        $category = $this->categoryRepository->categoryFindById($request->id);
        unlink($category->image);
        $category->update(['image' => null,]);
        return response()->json(['success' => true]);
    }

    public function changeCatOrder(Request $request)
    {
        $order = request('order');
        $cat_id = request('cat_id');
        $Category = $this->categoryRepository->categoryFindById($cat_id);
        $Category->update(['order' => $order]);
        return json_encode(true);
    }

    public function changeActivation($categoryId): \Illuminate\Http\RedirectResponse
    {
        $category = $this->categoryRepository->categoryFindById($categoryId);
        if ($category->depth == 1) {
            $categoryIds = Category::where('path', 'LIKE', '%' . $category->id . '%')
                ->pluck('id')->toArray();
            array_push($categoryIds, $category->id);
            foreach (Category::whereIn('id', $categoryIds)->get() as $cat) {
                $cat->update(['active' => !$category->active]);
            }
        } else {
            if (!$category->active == 1 && $category->category->active == 1) {
                foreach ($category->subCategories as $cat) {
                    $cat->update(['active' => !$category->active]);
                }
                $category->update(['active' => !$category->active]);
            }elseif(!$category->active == 0){
                foreach ($category->subCategories as $cat) {
                    $cat->update(['active' => !$category->active]);
                }
                $category->update(['active' => !$category->active]);
            }elseif (!$category->active == 1 && $category->category->active == 0){
                Alert::error('امکان فعال کردن دسته بندی نیست', 'دسته بندی '.$category->category->title.' غیرفعال است.');
            }
        }
        return redirect()->back();
    }
}

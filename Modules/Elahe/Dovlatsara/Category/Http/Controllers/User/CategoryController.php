<?php

namespace Modules\Category\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
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

    public function getChildCategory()
    {
        $id = request('category_id');

        $cs=[];
        $categories = Category::where('parent_id', $id)->where('active', 1)->get();
        if ($categories->count()>0) {
            foreach ($categories as $category) {
                $cs[$category->id] = $category->title;
            }
            return json_encode($cs);
        }else
            return json_encode($cs);
    }

}

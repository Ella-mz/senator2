<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function selectCategory($type, $panel, Request $request)
    {
        $category_id = $request->categoryId;
        $agency_id = $request->agency_id;
        if (isset($category_id))
            $cat = $this->categoryRepository->categoryFindById($category_id);

        if (!isset($category_id)) {
            $cats = $this->categoryRepository->categoryDepth1();
            if ($panel == 'user')
                return view('Categories::user.selectCategory',
                    compact('cats', 'type', 'agency_id', 'panel'));
            elseif ($panel == 'panel')
                return view('Categories::panel.selectCategory',
                    compact('cats', 'type', 'agency_id', 'panel'));
            elseif ($panel == 'admin')
                return view('Categories::admin.selectCategory',
                    compact('cats', 'type', 'agency_id', 'panel'));
        } else {
            $response = $this->categoryRepository->categoryDisplayInSubmittingProcess($cat, $type);
            return json_encode($response);
        }
    }

    public function prevCats($type, $panel, Request $request)
    {
        $category_id = $request->categoryId;
        $agency_id = $request->agency_id;
        $cat = $this->categoryRepository->categoryFindById($category_id);
        $response = $this->categoryRepository->categoryDisplayInSubmittingProcessReverse($cat, $type);
        return json_encode($response);
    }

}

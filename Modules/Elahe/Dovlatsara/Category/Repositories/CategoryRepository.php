<?php


namespace Modules\Category\Repositories;


use Modules\Category\Entities\Category;

class CategoryRepository
{

    public function categoryFindById($id)
    {
        return Category::find($id);
    }

    public function categoryFindByIds($ids)
    {
        return Category::whereIn('id', $ids)->where('active', 1)->get();
    }
    public function nodeIds()
    {
        return Category::where('node', 1)->pluck('id')->toArray();
    }

    public function nodeCatsWithIds($ids)
    {
        return Category::whereIn('id', $ids)->where('node', 1);
    }

    public function categoryDepth1()
    {
        return Category::where('active', 1)->where('depth', 1)->orderBy('order', 'asc')->get();
    }

    public function nodeCategories()
    {
        return Category::where('node', 1)->orderBy('order', 'asc')->get();
    }

    public function categoriesWithParentId($parentId)
    {
        return Category::where('parent_id', $parentId)->orderBy('order', 'asc')->get();
    }

    public function all()
    {
        return Category::orderBy('order', 'asc')->get();
    }

    public function all2()
    {
        return Category::orderBy('order', 'asc')->where('active', 1)->get();
    }
    public function categoryDisplayInSubmittingProcess($category, $type): array
    {
        $content = '';
        $content2 = '';

        $cats = $category->categories()->where('active', 1)->orderBy('order', 'asc')->get();
        $cats2 = $category->categories()->get();
        if (count($cats)) {
            $content2 = '<a class="btn btn-danger" onclick="prevCats(this.id)" id="' . $category->id . '">بازگشت به ' . $category->title . '</a>';
//                $content .= '<li class="li-bg-gray" onclick="prevCats(this.id)" id="' . $cat->id . '"><span>بازگشت به ' . $this->repo->findCategoryById($cat->id)->title . '</span><i class="fa fa-angle-right"></i></li>';
            foreach ($cats as $key => $c) {
                if ($key % 2 == 0) {
                    $content .= '<li class="li-bg-light-gray" onclick="nextCats(this.id)" id="' . $c->id . '"> <span>' . $c->title . ' </span><i class="fa fa-angle-left"></i></li>';
                } else {
                    $content .= '<li class="li-bg-gray" onclick="nextCats(this.id)" id="' . $c->id . '"> <span>' . $c->title . ' </span><i class="fa fa-angle-left"></i></li>';
                }
            }
            return ['content' => $content, 'backbutton' => $content2,];
        }elseif (count($cats2)){
            $content2 = '<a class="btn btn-danger" onclick="prevCats(this.id)" id="' . $category->id . '">بازگشت به ' . $category->title . '</a>';
            $content .= '<span class="text text-danger" style="font-size: 20px">امکان ثبت آگهی در این دسته بندی نیست.</span>';
            return ['content' => $content, 'backbutton' => $content2,];

        } else {
            return ['ad' => $type,];
        }
    }

    public function categoryDisplayInSubmittingProcessReverse($category, $type): array
    {
        if ($category->parent_id != 0) {
            $cat2 = $category->category()->first();
            $cats = $cat2->categories()->where('active', 1)->orderBy('order', 'asc')->get();
            $cats2 = $category->categories()->get();
        } else {
            $cat2 = $category;
            $cats = $this->categoryDepth1();
            $cats2 = $category->categories()->get();
        }
        $content = '';
        $content2 = '';
        if (count($cats)) {
            if ($category->parent_id != 0)
                $content2 = '<a class="btn btn-danger" onclick="prevCats(this.id)" id="' . $cat2->id . '">بازگشت به ' . $cat2->title . '</a>';
//                $content .= '<li class="li-bg-gray" onclick="prevCats(this.id)" id="' . $cat2->id . '"><span>بازگشت به ' . $this->repo->findCategoryById($cat2->id)->title . '</span><i class="fa fa-angle-right"></i></li>';
            foreach ($cats as $key => $c) {
                if ($key % 2 == 0) {
                    $content .= '<li class="li-bg-light-gray" onclick="nextCats(this.id)" id="' . $c->id . '"> <span>' . $c->title . ' </span><i class="fa fa-angle-left"></i></li>';

                } else {
                    $content .= '<li class="li-bg-gray" onclick="nextCats(this.id)" id="' . $c->id . '"> <span>' . $c->title . ' </span><i class="fa fa-angle-left"></i></li>';
                }
            }
            return ['content' => $content, 'backbutton' => $content2];
        }elseif (count($cats2)){
            $content2 = '<a class="btn btn-danger" onclick="prevCats(this.id)" id="' . $category->id . '">بازگشت به ' . $category->title . '</a>';
            $content .= '<span class="text text-danger" style="font-size: 20px">امکان ثبت آگهی در این دسته بندی نیست.</span>';
            return ['content' => $content, 'backbutton' => $content2,];

        } else {
            return ['ad' => $type,];
        }
    }

    public function activeCategoryIds()
    {
        return Category::where('active', 1)->pluck('id')->toArray();
    }
}

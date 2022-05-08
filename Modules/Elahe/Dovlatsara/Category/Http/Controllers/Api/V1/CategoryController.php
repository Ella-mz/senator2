<?php


namespace Modules\Category\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use Modules\Association\Entities\Association;
use Modules\Association\Transformers\AssociationCollection;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\Category\Transformers\CategoryCollection;
use Illuminate\Http\Response;
use Modules\User\Entities\Level2CategoryOfAgency;

class CategoryController extends Controller
{
    public $repo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repo = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::where('depth', 1)->get();

        return response()->json([
            'status_code' => 200,
            'data' => new CategoryCollection($categories),
        ], Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexLevel2($categoryId)
    {
        if (!$this->repo->categoryFindById($categoryId))
            return response()->json([
                'status_code' => 404,
                'errors' => 'Category Not Found',
            ], Response::HTTP_NOT_FOUND);
        $categories = $this->repo->categoryFindById($categoryId)->subCategories()->get();

        return response()->json([
            'status_code' => 200,
            'data' => new CategoryCollection($categories),
        ], Response::HTTP_OK);
    }

    public function indexLevel2WithAgency($categoryId, $agencyId)
    {
        $category = $this->repo->categoryFindById($categoryId);
        if (!$category)
            return response()->json([
                'status_code' => 404,
                'errors' => 'Category Not Found',
            ], Response::HTTP_NOT_FOUND);
        if ($category->depth == 1) {
            $catIds = Level2CategoryOfAgency::where('user_id', $agencyId)->pluck('category_id')->toArray();
            $categories = Category::whereIn('id', $catIds)->orderBy('order', 'asc')->get();
        } else
            $categories = $category->subCategories()->get();

        return response()->json([
            'status_code' => 200,
            'data' => new CategoryCollection($categories),
        ], Response::HTTP_OK);
    }
}

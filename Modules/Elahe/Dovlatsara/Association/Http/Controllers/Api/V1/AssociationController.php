<?php

namespace Modules\Association\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use Modules\Association\Entities\Association;
use Modules\Association\Transformers\AssociationCollection;
use Modules\City\Entities\City;
use Modules\City\Transformers\CityCollection;
use Modules\Neighborhood\Entities\Neighborhood;
use Illuminate\Http\Response;

class AssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $associations = Association::where('depth', 1)->get();

        return response()->json([
            'status_code' => 200,
            'data' => new AssociationCollection($associations),
        ], Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Association $association
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexLevel2(Association $association)
    {
        $associations = Association::where('parent_id', $association->id)->get();

        return response()->json([
            'status_code' => 200,
            'data' => new AssociationCollection($associations),
        ], Response::HTTP_OK);
    }
}

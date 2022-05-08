<?php

namespace Modules\City\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use Modules\City\Entities\City;
use Modules\City\Transformers\CityCollection;
use Modules\Neighborhood\Entities\Neighborhood;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cities = City::all();

        return response()->json([
            'status_code' => 200,
            'data' => new CityCollection($cities),
        ], Response::HTTP_OK);
    }
}

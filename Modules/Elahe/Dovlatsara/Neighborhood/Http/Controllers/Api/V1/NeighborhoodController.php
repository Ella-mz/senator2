<?php

namespace Modules\Neighborhood\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\City\Entities\City;
use Modules\City\Transformers\CityCollection;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\Neighborhood\Transformers\NeighborhoodCollection;
use RealRashid\SweetAlert\Facades\Alert;

class NeighborhoodController extends Controller
{
    public function index(City $city)
    {
        if (!$city)
            return response()->json([
                'status_code' => 404,
                'errors' => '',
            ], Response::HTTP_NOT_FOUND);
        $neighborhoods = Neighborhood::where('city_id', $city->id)->get();
            return response()->json([
                'status_code' => 200,
                'data' => new NeighborhoodCollection($neighborhoods),
            ], Response::HTTP_OK);
    }

    public function getMultiCity(Request $request)
    {
//        if (!$city)
//            return response()->json([
//                'status_code' => 404,
//                'errors' => '',
//            ], Response::HTTP_NOT_FOUND);

//        $neighborhoods = Neighborhood::where('city_id', $city->id)->get();
        $cities = City::whereIn('id', json_decode($request['city'], true))->get();
        return response()->json([
            'status_code' => 200,
            'data' => new CityCollection($cities),
        ], Response::HTTP_OK);
    }
}

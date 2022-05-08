<?php

namespace Modules\City\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\City\Entities\City;

class CityController extends Controller
{
    public function show()
    {
        $cities = City::all();
        return view('Cities::admin.test', compact('cities'));
    }

    public function set_cookie_of_city(Request $request)
    {
        if ($request->city == 'select-all')
            \session(['cities' => []]);
        else
            \session(['cities' => $request->city]);

        return redirect()->back();
    }

    public function getLatAndLng(Request $request)
    {
        $city = City::find($request->city);
        $cityCenter = [];
        if ($city->latitude && $city->longitude)
            $cityCenter = [(float)$city->latitude, (float)$city->longitude];
        return json_encode($cityCenter);
    }
}

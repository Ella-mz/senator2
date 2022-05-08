<?php

namespace Modules\Neighborhood\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;
use RealRashid\SweetAlert\Facades\Alert;

class NeighborhoodController extends Controller
{
    public function neighborhoods()
    {
        $id = request('city');

        $ns=[];
        $neighborhoods = Neighborhood::where('city_id', $id)->get();
        if ($neighborhoods->count()>0) {
            foreach ($neighborhoods as $neighborhood) {
                $ns[$neighborhood->id] = $neighborhood->title;
            }
            return json_encode($ns);
        }else
            return json_encode($ns);
    }

    public function neighborhoodOld(Request $request)
    {
        $city = City::find($request->cityId);
        $content = '';
        foreach ($city->neighborhoods as $neighbor) {
            if (in_array($neighbor->id, ($request->neighborhoodIds))) {
                $content .= '<option value="' . $neighbor->id . '" selected>' . $neighbor->title . '</option>...';
            } else
                $content .= '<option value="' . $neighbor->id . '">' . $neighbor->title . '</option>...';
        }
        return json_encode(['content' => $content]);
    }
}

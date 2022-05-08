<?php

namespace Modules\Neighborhood\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;

class NeighborhoodController extends Controller
{
    public function neighborhoodOld(Request $request)
    {
        $city = City::find($request->cityId);
        $neighborhood = Neighborhood::find($request->neighborhoodId);
        $content = '';
        $content .= '<div><label> محله</label><select name="neighborhood" class="full" style="height: 45px">';
        foreach ($city->neighborhoods as $neighbor) {
            if ($neighbor->id == $neighborhood->id) {
                $content .= '<option value="' . $neighbor->id . '" selected>' . $neighbor->title . '</option>';
            } else
                $content .= '<option value="' . $neighbor->id . '">' . $neighbor->title . '</option>';
        }
        $content .= '</select></div>';
        return json_encode(['content' => $content]);
    }
}

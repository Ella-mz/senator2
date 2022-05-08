<?php

namespace Modules\Neighborhood\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\Ad\Entities\Ad;
use Modules\Application\Entities\ApplicationNeighborhood;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;
use RealRashid\SweetAlert\Facades\Alert;

class NeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
//            'latitude' => 'numeric',
//            'longitude' => 'numeric',
        'geographicalDirection'=>'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        foreach (Neighborhood::all() as $neighbor){
            if ($request->title==$neighbor->title){
                Alert::error('تکراری', 'امکان ایجاد محله با این عنوان وجود ندارد');
                return redirect()->back();
            }
        }
        $neighborhood = Neighborhood::create(
            [
                'city_id' => $request->city,
                'title' => $request->title,
                'longitude' => $request->longitude,
                'created_user' => Auth::id(),
                'latitude' => $request->latitude,
                'geographicalDirection'=>$request->geographicalDirection,
            ]
        );
        Alert::success('', 'محله با موفقیت ثبت شد');
        return redirect()->route('neighborhoods.index.admin', $neighborhood->city_id);
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $neighborhood = Neighborhood::find($id);
        return view('Neighborhoods::admin.edit', compact( 'neighborhood'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
//            'latitude' => 'numeric',
//            'longitude' => 'numeric',
            'geographicalDirection'=>'required'

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $neighborhood = Neighborhood::find($id);

        foreach (Neighborhood::all() as $neighbor){
            if ($neighbor->id != $neighborhood->id) {
                if ($request->title == $neighbor->title) {
                    Alert::error('تکراری', 'امکان ایجاد محله با این عنوان وجود ندارد');
                    return redirect()->back();
                }
            }
        }
        $neighborhood->update(
            [
                'title' => $request->title,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'geographicalDirection'=>$request->geographicalDirection,
                'updated_user' => Auth::id(),
            ]
        );
        Alert::success('', 'محله با موفقیت ویرایش شد');
        return redirect()->route('neighborhoods.index.admin', $neighborhood->city_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $neighborhood = Neighborhood::find($id);
//        if ($neighborhood->ads->count() <= 0) {
            $activityRanges = ActivityRange::where('neighborhood_id', $neighborhood->id)->get();
            foreach ($activityRanges as $range){
                $range->delete();
            }
            foreach (Ad::where('neighborhood_id', $id)->get() as $ad){
                $ad->update(['neighborhood_id'=>null]);
            }
            foreach (ApplicationNeighborhood::where('neighborhood_id', $id)->get() as $app){
                $app->delete();
            }
            $neighborhood->delete();
            Alert::success('', 'محله با موفقیت حذف شد');
            return redirect()->back();
//        }else{
//            Alert::error('قابل حذف نیست', 'به محله '.$neighborhood->title.' آگهی نسبت داده شده است.');
////            Alert::error('', 'به این محله آگهی نسبت داده شده است.');
//            return redirect()->back();
//        }
    }

    public function showNeighborhoods(City $city)
    {
        $neighborhoods = Neighborhood::where('city_id', $city->id)->get();
        return view('Neighborhoods::admin.index', compact('neighborhoods', 'city'));
    }

    public function addNeighborhood(City $city)
    {
        return view('Neighborhoods::admin.create', compact('city'));

    }

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

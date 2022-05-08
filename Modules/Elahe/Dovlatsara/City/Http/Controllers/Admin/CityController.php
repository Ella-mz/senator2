<?php

namespace Modules\City\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;
use RealRashid\SweetAlert\Facades\Alert;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $paginate = 50;

        $cities = City::paginate($paginate);
        return view('Cities::admin.index', compact('cities', 'paginate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('Cities::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
//            'latitude' => 'numeric',
//            'longitude' => 'numeric',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        foreach (City::all() as $ci){
            if ($request->title==$ci->title){
                Alert::error('تکراری', 'امکان ایجاد شهر با این عنوان وجود ندارد');
                return redirect()->back();
            }
        }
        $city = City::create(
            [
                'title' => $request->title,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'created_user' => Auth::id(),
            ]
        );
        Alert::success('', 'شهر با موفقیت ثبت شد');
        return redirect()->route('cities.index');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $city = City::find($id);
        return view('Cities::admin.edit', compact('city'));

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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $city = City::find($id);

        foreach (City::all() as $ci){
            if ($ci->id != $city->id) {
                if ($request->title == $ci->title) {
                    Alert::error('تکراری', 'امکان ایجاد شهر با این عنوان وجود ندارد');
                    return redirect()->back();
                }
            }
        }
        $city->update(
            [
                'title' => $request->title,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'updated_user' => Auth::id(),
            ]
        );
        Alert::success('', 'شهر با موفقیت ویرایش شد');
        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $ne = [];
        foreach (Neighborhood::where('city_id', $city->id)->get() as $neighborhood) {
            array_push($ne, $neighborhood->id);
        }
        if ($city->ads->count()<=0) {
            $neighborhoods = Neighborhood::whereIn('id', $ne)->get();
            foreach ($neighborhoods as $n) {
                $activityRanges = ActivityRange::where('neighborhood_id', $n->id)->get();
                foreach ($activityRanges as $range){
                    $range->update(['deleted_user' => \auth()->id(),]);
                    $range->delete();
                }
                $n->update(['deleted_user' => \auth()->id(),]);
                $n->delete();
            }
            $city->update(['deleted_user' => \auth()->id(),]);
            $city->delete();
            Alert::success('', 'شهر با محله های زیرمجموعه ی آن با موفقیت حذف شد.');
            return redirect()->back();
        } else {
            Alert::error('قابل حذف نیست', 'به شهر '.$city->title.' آگهی نسبت داده شده است.');
            return redirect()->back();
        }
    }
}

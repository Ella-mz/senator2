<?php

namespace Modules\AdvertisingFee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\AdvertisingFee\Entities\AdvertisingFee;
use Modules\AdvertisingFee\Http\Requests\Admin\StoreRequest;
use Modules\AdvertisingFee\Http\Requests\Admin\UpdateRequest;
use Modules\Category\Entities\Category;
use Modules\GroupAttribute\Entities\GroupAttribute;
use RealRashid\SweetAlert\Facades\Alert;

class AdvertisingFeeController extends Controller
{
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
////        $adFees = AdvertisingFee::all();
////        return view('AdvertisingFees::admin.index', compact('adFees'));
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(StoreRequest $request)
//    {
//        $adFee = AdvertisingFee::create(
//            [
//                'category_id' => $request->category,
//                'expireTimeOfAds' => $request->expireTimeOfAds,
//                'generalAdFee' => $request->generalAdFee,
//                'scalarAdFee' => $request->scalarAdFee,
//                'specialAdFee' => $request->specialAdFee,
//                'emergencyAdFee' => $request->emergencyAdFee,
//                'created_user' => Auth::id(),
//            ]
//        );
//        Alert::success('', 'هزینه با موفقیت ثبت شد');
//        return redirect()->route('advertisingFee.index.admin', $adFee->category_id);
//    }
//
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
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        $adFee = AdvertisingFee::find($id);
//        return view('AdvertisingFees::admin.edit', compact( 'adFee'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(UpdateRequest $request, $id)
//    {
//        $adFee = AdvertisingFee::find($id);
//        $adFee->update(
//            [
//                'expireTimeOfAds' => $request->expireTimeOfAds,
//                'generalAdFee' => $request->generalAdFee,
//                'scalarAdFee' => $request->scalarAdFee,
//                'specialAdFee' => $request->specialAdFee,
//                'emergencyAdFee' => $request->emergencyAdFee,
//                'updated_user' => Auth::id(),
//            ]
//        );
//        Alert::success('', 'هزینه با موفقیت ویرایش شد');
//        return redirect()->route('advertisingFee.index.admin', $adFee->category_id);
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        $adFee = AdvertisingFee::find($id);
//        $adFee->delete();
//        Alert::success('', 'هزینه با موفقیت حذف شد.');
//        return redirect()->back();
//    }
//
//    public function showAdvertisingFees(Category $category)
//    {
//        $adFees = AdvertisingFee::where('category_id', $category->id)->get();
//        return view('AdvertisingFees::admin.index', compact('adFees', 'category'));
//    }
//
//    public function addAdvertisingFee(Category $category)
//    {
//        return view('AdvertisingFees::admin.create', compact('category'));
//    }
}

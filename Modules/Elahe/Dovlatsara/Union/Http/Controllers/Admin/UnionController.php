<?php

namespace Modules\Union\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Union\Entities\Union;
use RealRashid\SweetAlert\Facades\Alert;

class UnionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unions = Union::all();
        return view('Unions::admin.index', compact('unions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Unions::admin.create');
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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        foreach (Union::all() as $uni){
            if ($request->title==$uni->title){
                Alert::error('تکراری', 'امکان ایجاد صنف با این عنوان وجود ندارد');
                return redirect()->back();
            }
        }
        $union = Union::create(
            [
                'title' => $request->title,
                'created_user' => Auth::id(),
            ]
        );
        Alert::success('', 'صنف با موفقیت ثبت شد');
        return redirect()->route('unions.index');
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
        $union = Union::find($id);
        return view('Unions::admin.edit', compact('union'));
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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $union = Union::find($id);

        foreach (Union::all() as $uni){
            if ($uni->id != $union->id) {
                if ($request->title == $uni->title) {
                    Alert::error('تکراری', 'امکان ایجاد صنف با این عنوان وجود ندارد');
                    return redirect()->back();
                }
            }
        }
        $union->update(
            [
                'title' => $request->title,
                'updated_user' => Auth::id(),
            ]
        );
        Alert::success('', 'صنف با موفقیت ویرایش شد');
        return redirect()->route('unions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $union = Union::find($id);
//        if ($union->shops==null){
            $union->delete();
            Alert::success('', 'صنف با موفقیت حذف شد.');
            return redirect()->back();
//        }else{
//            Alert::error('قابل حذف نیست.','صنف دارای فروشگاه زیرمجموعه است.');
//            return redirect()->back();
//        }
    }
}

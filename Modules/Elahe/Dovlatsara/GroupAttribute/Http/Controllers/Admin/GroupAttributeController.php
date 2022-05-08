<?php

namespace Modules\GroupAttribute\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Modules\Attribute\Entities\Attribute;
use Modules\AttributeItem\Entities\AttributeItem;
use Modules\Category\Entities\Category;
use Modules\GroupAttribute\Entities\GroupAttribute;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class GroupAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $groupAttrs = GroupAttribute::all();
        return view('GroupAttributes::admin.index', compact('groupAttrs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('GroupAttributes::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'advertiser' => 'required',
            'numberOfColumnsForDisplay' => Rule::requiredIf($request->advertiser=='supplier'),
            'type' => Rule::requiredIf($request->advertiser=='supplier'),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $lastGroupAttr = GroupAttribute::where('advertiser', $request->advertiser)->orderBy('order', 'desc')->first();
        $groupAttr = GroupAttribute::create(
            [
                'category_id' => $request->category,
                'type' => $request->advertiser=='supplier'?$request->type:'none',
                'title' => $request->title,
                'advertiser' => $request->advertiser,
                'created_user' => \auth()->id(),
                'numberOfColumnsForDisplay' => $request->advertiser=='supplier'?$request->numberOfColumnsForDisplay:20,
                'order'=>$lastGroupAttr==null?1:$lastGroupAttr->order+1,
                'hidden'=>$request->hidden=='on'?1:0,
            ]
        );
        Alert::success('', 'گروه مشخصه با موفقیت ثبت شد');
        return redirect()->route('groupAttrs.index.admin', $groupAttr->category_id);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $groupAttr = GroupAttribute::find($id);
        return view('GroupAttributes::admin.edit', compact( 'groupAttr'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'advertiser' => 'required',
            'numberOfColumnsForDisplay' => Rule::requiredIf($request->advertiser=='supplier'),
            'type' => Rule::requiredIf($request->advertiser=='supplier'),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $groupAttr = GroupAttribute::find($id);

        $groupAttr->update(
            [
                'advertiser' => $request->advertiser,
                'type' => $request->advertiser=='supplier'?$request->type:'none',
                'title' => $request->title,
                'numberOfColumnsForDisplay' => $request->advertiser=='supplier'?$request->numberOfColumnsForDisplay:20,
                'updated_user' => \auth()->id(),
                'hidden'=>$request->hidden=='on'?1:0,
            ]
        );
        Alert::success('', 'گروه مشخصه با موفقیت ویرایش شد');
        return redirect()->route('groupAttrs.index.admin', $groupAttr->category_id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $groupAttr = GroupAttribute::find($id);
        foreach (Attribute::where('groupAttribute_id', $id)->get() as $attr){
            $attr->ads()->detach();
            foreach (AttributeItem::where('attribute_id', $attr->id)->get() as $attrItem){
                $attrItem->update(['deleted_user'=>\auth()->id()]);
                $attrItem->delete();
            }
            $attr->update(['deleted_user'=>\auth()->id()]);
            $attr->delete();
        }
        $groupAttr->update(['deleted_user'=>\auth()->id()]);
        $groupAttr->delete();
        Alert::success('', 'گروه مشخصه با موفقیت حذف شد');
        return redirect()->back();
    }

    public function showGroupAttributes(Category $category)
    {
        $groupAttrs = GroupAttribute::where('category_id', $category->id)->orderby('order', 'Asc')->get();
        return view('GroupAttributes::admin.index', compact('groupAttrs', 'category'));
    }

    public function addGroupAttribute(Category $category)
    {
        return view('GroupAttributes::admin.create', compact('category'));

    }

    public function changeGroupAttrOrder(Request $request)
    {
        $order = request('order');
        $groupAttr_id = request('groupAttr_id');
        $groupAttr = GroupAttribute::find($groupAttr_id);
        $groupAttr->update(['order'=>$order]);
        return json_encode(true);
    }
}

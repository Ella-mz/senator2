<?php

namespace Modules\AttributeItem\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Attribute\Entities\Attribute;
use Modules\AttributeItem\Entities\AttributeItem;
use RealRashid\SweetAlert\Facades\Alert;

class AttributeItemController extends Controller
{
    public function index(Attribute $attribute)
    {
        $items = AttributeItem::where('attribute_id', $attribute->id)->orderby('created_at','desc')->get();

        return view('AttributeItems::admin.index ', compact('items','attribute'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Attribute::find($request->attribute)->attribute_type == 'bool'){
            if (AttributeItem::where('attribute_id', $request->attribute)->get()->count()>=2){
                Alert::error('', 'مشخصه آیتم از نوع دو گزینه ای است.');
                return redirect()->back();
            }
        }
        if(Attribute::find($request->attribute)->attribute_type == 'bool'
            || Attribute::find($request->attribute)->attribute_type == 'select') {
            $item = AttributeItem::create(
                [
                    'attribute_id' => $request->attribute,
                    'title' => $request->title,
                    'created_user' => \auth()->id(),
                ]
            );
        }else
            return redirect()->back();

        Alert::success('', 'آیتم با موفقیت ثبت شد');
        return redirect()->route('show.items.admin',$item->attribute_id);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'itemtitle' =>  'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'errorValidation' => $validator->errors()->all(),
                '</br>'
            ]);
        }
        $item = AttributeItem::where('id', $request['itemid'])->update(
            [
                'title' => $request['itemtitle'],
            ]
        );

        return response()->json([
            'success' => '<div class="alert alert-success"  style="font-size: small">ویرایش با موفقیت انجام شد</div>',
        ]);

    }

    public function destroy(AttributeItem $attributeItem)
    {
        $attributeItem->update(['deleted_user'=>\auth()->id()]);
        $attributeItem->ads()->detach();
        $attributeItem->delete();
        Alert::success(' ', 'آیتم با موفقیت حذف شد');
        return redirect()->route('show.items.admin',$attributeItem->attribute_id);
    }

}

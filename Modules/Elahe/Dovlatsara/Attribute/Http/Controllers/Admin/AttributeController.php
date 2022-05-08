<?php


namespace Modules\Attribute\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Attribute\Entities\Attribute;
use Modules\Attribute\Http\Requests\Admin\StoreRequest;
use Modules\Attribute\Http\Requests\Admin\UpdateRequest;
use Modules\GroupAttribute\Entities\GroupAttribute;
use RealRashid\SweetAlert\Facades\Alert;

class AttributeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $attribute = Attribute::create(
            [
                'groupAttribute_id' => $request->groupAttr,
                'title' => $request->title,
                'alt_value' => $request->alt_value,
                'attribute_type' => $request->attribute_type,
                'input_type' => $request->attribute_type == 'bool' || $request->attribute_type == 'select' ? $request->input_type : null,
                'unit' => $request->unit,
                'isSignificant' => $request->significant == 'on' ? 1 : 0,
                'isFilterField' => $request->isFilterField == 'on' ? 1 : 0,
                'created_user' => \auth()->id(),
                'placeHolder' => $request->placeHolder,
                'hasScale'=> $request->hasScale == 'on' ? 1 : 0,
            ]
        );
        Alert::success('', 'مشخصه با موفقیت ثبت شد');
        return redirect()->route('attrs.index.admin', $attribute->groupAttribute_id);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return view('Attributes::admin.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $attribute = Attribute::find($id);
        if ($request->attribute_type != $attribute->attribute_type && $request->attribute_type == 'select'){
            $attribute->ads()->detach();
        }

        if ($attribute->attribute_type == 'select' && $request->attribute_type != 'select'){
            foreach ($attribute->attrItem()->get() as $attrItem) {
                $attrItem->update(['deleted_at' => \auth()->id()]);
                $attrItem->ads()->detach();
                $attrItem->delete();
            }
        }
            $attribute->update(
                [
                    'title' => $request->title,
                    'attribute_type' => $request->attribute_type,
                    'input_type' => $request->input_type,
                    'unit' => $request->unit,
                    'alt_value' => $request->alt_value,
                    'updated_user' => \auth()->id(),
                    'isSignificant' => $request->significant == 'on' ? 1 : 0,
                    'isFilterField' => $request->isFilterField == 'on' ? 1 : 0,
                    'placeHolder' => $request->placeHolder,
                    'hasScale' => $request->hasScale == 'on' ? 1 : 0,
                ]
            );
        Alert::success('', 'مشخصه با موفقیت ویرایش شد');
        return redirect()->route('attrs.index.admin', $attribute->groupAttribute_id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $attribute = Attribute::find($id);
        foreach ($attribute->attributeItems()->get() as $attrItem) {
            $attrItem->update(['deleted_at' => \auth()->id()]);
            $attrItem->ads()->detach();
            $attrItem->delete();
        }
        $attribute->ads()->detach();
        $attribute->update(['deleted_at' => \auth()->id()]);
        $attribute->delete();
        Alert::success('', 'مشخصه با موفقیت حذف شد');
        return redirect()->back();
    }

    public function showAttributes(GroupAttribute $groupAttribute)
    {
        $attributes = Attribute::where('groupAttribute_id', $groupAttribute->id)->get();
        return view('Attributes::admin.index', compact('attributes', 'groupAttribute'));
    }

    public function addAttribute(GroupAttribute $groupAttribute)
    {
        return view('Attributes::admin.create', compact('groupAttribute'));
    }
}

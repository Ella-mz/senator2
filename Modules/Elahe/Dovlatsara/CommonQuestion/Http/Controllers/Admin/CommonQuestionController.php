<?php

namespace Modules\CommonQuestion\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\City\Entities\City;
use Modules\CommonQuestion\Entities\CommonQuestion;
use RealRashid\SweetAlert\Facades\Alert;

class CommonQuestionController extends Controller
{
    public function index()
    {
        $commonQuestions = CommonQuestion::all();
        return view('CommonQuestions::admin.index', compact('commonQuestions'));
    }

    public function create()
    {
        return view('CommonQuestions::admin.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $commonQuestion = CommonQuestion::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'created_user' => \auth()->id(),
            ]
        );
        Alert::success('', 'سوال با موفقیت ثبت شد');
        return redirect()->route('commonQuestions.index.admin');
    }

    public function edit(CommonQuestion $commonQuestion)
    {
        return view('CommonQuestions::admin.edit', compact('commonQuestion'));
    }

    public function update(Request $request, CommonQuestion $commonQuestion)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $commonQuestion->update(
            [
                'title' => $request->title,
                'description' => $request->description,
                'updated_user' => \auth()->id(),
            ]
        );
        Alert::success('', 'سوال با موفقیت ویرایش شد');
        return redirect()->route('commonQuestions.index.admin');
    }

    public function destroy(CommonQuestion $commonQuestion)
    {
        $commonQuestion->update(['deleted_user' => \auth()->id(),]);
        $commonQuestion->delete();
        Alert::success('', 'سوال با موفقیت حذف شد');
        return redirect()->route('commonQuestions.index.admin');
    }
}

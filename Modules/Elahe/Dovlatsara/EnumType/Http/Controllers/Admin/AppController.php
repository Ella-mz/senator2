<?php

namespace Modules\EnumType\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Enum\Entities\Enum;
use Modules\EnumType\Entities\EnumType;
use RealRashid\SweetAlert\Facades\Alert;


class AppController extends Controller
{
    use UploadFileTrait;

    public function create()
    {
        $Enum = Enum::where('title', 'appOfWebsite')->first();
        $appOfWebsite = EnumType::where('enum_id', $Enum->id)->first();
        return view('EnumTypes::admin.app.create', compact('appOfWebsite'));
    }

    public function store(Request $request)
    {
        $Enum = Enum::where('title', 'appOfWebsite')->first();
        $appOfWebsite = EnumType::where('enum_id', $Enum->id)->first();

        $validator = Validator::make($request->all(), [
            'file' => Rule::requiredIf(!$appOfWebsite->link),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->file('file')) {
            if (isset($appOfWebsite->link))
                File::delete(public_path($appOfWebsite->link));
            $file = $this->uploadFile($request->file('file'), 'public/upload/app/file/' . now()->year
                . '/' . now()->month);
        } else
            $file = $appOfWebsite->link;

        if ($appOfWebsite) {
            $appOfWebsite->update([
                'description' => $request->description,
                'link' => $file,
                'title' => $request->file('file') ? $request->file('file')->getClientOriginalName(): $appOfWebsite->title
            ]);
        } else {
            $appOfWebsite = EnumType::create([
                'enum_id' => $Enum->id,
                'link' => $file,
                'description' => $request->description,
                'title' => $request->file('file')->getClientOriginalName()
            ]);
        }
        Alert::success('', 'درخواست شما با موفقیت ثبت شد');
        return view('EnumTypes::admin.app.create', compact('appOfWebsite'));
    }

    /**
     * @param $enumType
     */
    public function download($enumType)
    {
        $appOfWebsite = EnumType::find($enumType);
        $headers = array(
            'Content-Type'=>'application/vnd.android.package-archive',
            'Content-Disposition'=> 'attachment; filename="dolatsara.apk"',
        );
        return response()->download($appOfWebsite->link, $appOfWebsite->title, $headers);
    }
}

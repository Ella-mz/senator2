<?php

namespace Modules\EnumType\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Enum\Entities\Enum;
use Modules\EnumType\Entities\EnumType;
use RealRashid\SweetAlert\Facades\Alert;


class ContactUsController extends Controller
{

    public function index()
    {
        $contactUs = DB::table('contact_us')->orderByDesc('created_at')->get();

        return view('EnumTypes::admin.contactUs.index', compact('contactUs'));

        return view('admin.footer.contactUs', compact('contactUs'));
    }
    public function create()
    {
        $Enum = Enum::where('title', 'contactUs')->first();
        $contactUs = EnumType::where('enum_id', $Enum->id)->first();
        return view('EnumTypes::admin.contactUs.create', compact('contactUs'));

//        return view('admin.footer.aboutUs', compact('aboutUs'));
    }

    public function store(Request $request)
    {
        $Enum = Enum::where('title', 'aboutUs')->first();
        $aboutUs = EnumType::where('enum_id', $Enum->id)->first();
        if ($aboutUs) {
            $aboutUs->update([
                'description' => $request->description,
                'mobile' => $request->mobile,
                'phone' => $request->phone,
                'email' => $request->email,
                'link' => $request->link,
            ]);
        } else {
            $aboutUs = EnumType::create([
                'enum_id' => $Enum->id,
                'description' => $request->description,
                'mobile' => $request->mobile,
                'phone' => $request->phone,
                'email' => $request->email,
                'link' => $request->link,
            ]);
        }
        Alert::success('', 'درخواست شما با موفقیت ثبت شد');
        return view('EnumTypes::admin.aboutUs.create', compact('aboutUs'));
    }
}

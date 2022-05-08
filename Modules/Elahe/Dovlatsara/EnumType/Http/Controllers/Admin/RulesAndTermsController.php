<?php

namespace Modules\EnumType\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Enum\Entities\Enum;
use Modules\EnumType\Entities\EnumType;
use RealRashid\SweetAlert\Facades\Alert;


class RulesAndTermsController extends Controller
{
    public function create()
    {
        $Enum = Enum::where('title', 'rulesAndTerms')->first();
        $rulesAndTerms = EnumType::where('enum_id', $Enum->id)->first();
        return view('EnumTypes::admin.rulesAndTerms.create', compact('rulesAndTerms'));
    }

    public function store(Request $request)
    {
        $Enum = Enum::where('title', 'rulesAndTerms')->first();
        $rulesAndTerms = EnumType::where('enum_id', $Enum->id)->first();
        if ($rulesAndTerms) {
            $rulesAndTerms->update([
                'description' => $request->description,
            ]);
        } else {
            $rulesAndTerms = EnumType::create([
                'enum_id' => $Enum->id,
                'description' => $request->description,
            ]);
        }
        Alert::success('', 'با موفقیت ثبت شد');
        return view('EnumTypes::admin.rulesAndTerms.create', compact('rulesAndTerms'));
    }
}

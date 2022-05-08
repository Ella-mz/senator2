<?php

namespace Modules\EnumType\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Enum\Entities\Enum;
use Modules\EnumType\Entities\EnumType;
use RealRashid\SweetAlert\Facades\Alert;


class RulesAndTermsController extends Controller
{
    public function index()
    {
        $Enum = Enum::where('title', 'rulesAndTerms')->first();
        $rulesAndTerms = EnumType::where('enum_id', $Enum->id)->first();
        return view('EnumTypes::user.rulesAndTerms.index', compact('rulesAndTerms'));

    }

}

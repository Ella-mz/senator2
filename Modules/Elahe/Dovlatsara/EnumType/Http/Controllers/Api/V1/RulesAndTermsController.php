<?php

namespace Modules\EnumType\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;


class RulesAndTermsController extends Controller
{
    public function index()
    {
        return response()->json([
            'data'=>url('docs/rules-and-terms'),
            'status_code'=>200
        ], Response::HTTP_OK);

    }

}

<?php

namespace Modules\RealestateMaster\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Modules\Neighborhood\Entities\Neighborhood;

class RealestateMasterController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('RealestateMaster::index');

    }


}


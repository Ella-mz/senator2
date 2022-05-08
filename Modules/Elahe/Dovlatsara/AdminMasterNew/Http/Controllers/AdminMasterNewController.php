<?php

namespace Modules\AdminMasterNew\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AdminMasterNewController extends Controller
{
    /**
     * @return View
     */
    public function index() :View
    {
        return view('AdminMasterNew::index');

    }
}

<?php

namespace Modules\UserMaster\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\RoleAndPermission\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Http\Requests\Admin\UpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\AdminMaster\Http\Traits;
use Illuminate\Http\JsonResponse;

class UserMasterController extends Controller
{

    public function index()
    {
        return view('UserMaster::index');
    }

    public function home()
    {
        return view('UserMaster::home');

    }
}

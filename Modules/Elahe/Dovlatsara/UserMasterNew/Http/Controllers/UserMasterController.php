<?php

namespace Modules\UserMasterNew\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\EnumType\Repositories\EnumTypeRepository;

class UserMasterController extends Controller
{
    private $enumTypeRepository;

    public function __construct(EnumTypeRepository $enumTypeRepository)
    {
        $this->enumTypeRepository = $enumTypeRepository;
    }

    public function index()
    {
        return view('UserMasterNew::index');
    }

    public function home()
    {
        return view('UserMasterNew::home');

    }

    public function header()
    {
        $widgets = $this->enumTypeRepository->findEnumTypesByEnumTitle('header_icons');
        return view('UserMasterNew::layouts.header', compact('widgets'));
    }
}

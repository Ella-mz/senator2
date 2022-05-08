<?php

namespace Modules\EnumType\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Enum\Entities\Enum;
use Modules\EnumType\Entities\EnumType;
use Modules\EnumType\Repositories\EnumTypeRepository;
use Modules\EnumType\Http\Requests\Admin\HeaderIcon\StoreRequest;
use RealRashid\SweetAlert\Facades\Alert;


class HeaderIconController extends Controller
{
    use UploadFileTrait;

    private $enumTypeRepository;

    public function __construct(EnumTypeRepository $enumTypeRepository)
    {
        $this->enumTypeRepository = $enumTypeRepository;
    }

    public function index()
    {
        $header_icons = $this->enumTypeRepository->findEnumTypesByEnumTitle('header_icons');
        return view('EnumTypes::admin.headerIcon.index', compact('header_icons'));
    }

    public function create()
    {
        return view('EnumTypes::admin.headerIcon.create');
    }


    public function store(StoreRequest $request)
    {
        if ($request->file('icon')) {
            $image = $this->uploadFile($request->file('icon'),
                'public/upload/headerIcon/icon/' . now()->year
                . '/' . now()->month);
        } else
            $image = null;

        $Enum = Enum::where('title', 'header_icons')->first();
        $header_icon = EnumType::create([
            'enum_id' => $Enum->id,
            'link' => $request->link,
            'image' => $image,
        ]);
        Alert::success('', 'درخواست شما با موفقیت ثبت شد');
        return redirect(route('header_icon.index.admin'));
    }

    public function destroy($header_iconId)
    {
        $header_icon = EnumType::find($header_iconId);
        $header_icon->delete();
        Alert::success('', 'آیکون با موفقیت حذف شد');
        return redirect(route('header_icon.index.admin'));
    }
}

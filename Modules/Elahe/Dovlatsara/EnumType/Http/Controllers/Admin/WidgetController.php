<?php

namespace Modules\EnumType\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Enum\Entities\Enum;
use Modules\EnumType\Entities\EnumType;
use Modules\EnumType\Repositories\EnumTypeRepository;
use Modules\EnumType\Http\Requests\Admin\Widget\StoreRequest;
use RealRashid\SweetAlert\Facades\Alert;


class WidgetController extends Controller
{
    use UploadFileTrait;

    private $enumTypeRepository;

    public function __construct(EnumTypeRepository $enumTypeRepository)
    {
        $this->enumTypeRepository = $enumTypeRepository;
    }

    public function index()
    {
        $widgets = $this->enumTypeRepository->findEnumTypesByEnumTitle('widget');
        return view('EnumTypes::admin.widget.index', compact('widgets'));
    }

    public function create()
    {
        return view('EnumTypes::admin.widget.create');
    }


    public function store(StoreRequest $request)
    {
        if ($request->file('icon')) {
            $image = $this->uploadFile($request->file('icon'),
                'public/upload/widget/icon/' . now()->year
                . '/' . now()->month);
        } else
            $image = null;

        $Enum = Enum::where('title', 'widget')->first();
        $widget = EnumType::create([
            'enum_id' => $Enum->id,
            'title' => $request->title,
            'link' => $request->link,
            'image' => $image,
        ]);
        Alert::success('', 'درخواست شما با موفقیت ثبت شد');
        return redirect(route('widget.index.admin'));
    }

    public function destroy($widget)
    {
        $widget = EnumType::find($widget);
        $widget->delete();
        Alert::success('', 'ویجت با موفقیت حذف شد');
        return redirect(route('widget.index.admin'));
    }
}

<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Modules\Setting\Repository\SettingRepository;
use Modules\AdminMasterNew\Http\Traits;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    use Traits\UploadFileTrait;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

      $settings = $this->settingRepository->all();
        return view('Settings::admin.index', compact('settings'));
    }

    /**
     * @param $settingId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($settingId)
    {
        $setting = $this->settingRepository->settingFindById($settingId);
        return view('Settings::admin.create', compact('setting'));
    }

    /**
     * @param Request $request
     * @param $settingId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $settingId)
    {
        $setting = $this->settingRepository->settingFindById($settingId);

        if (($setting->type=='file') || $setting->type=='fileAndLink') {
            if ($request->file('title')) {
                $title = $this->uploadFile($request->file('title'), 'public/upload/setting/'.$setting->title.'/' . now()->year
                    . '/' . now()->month);
                $setting->update(['str_value' => $title,'link' => $request->link,]);
            }

        }else{
            $setting->update([
                'str_value' => $request->title,
            ]);
        }
        \alert()->success('', 'با موفقیت ثبت شد.');
        return redirect()->route('setting.index.admin');
    }

    /**
     * @param $settingId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($settingId)
    {
        $setting = $this->settingRepository->settingFindById($settingId);

        if (($setting->type=='file') || $setting->type=='fileAndLink'){
            File::delete(public_path($setting->str_value));
            $setting->update(['str_value' => null,'link' => null]);
        }
        else
            $setting->update(['str_value' => null,]);

        \alert()->success('', 'با موفقیت حذف شد.');
        return redirect()->route('setting.index.admin');
    }

    public function get_setting_text(Request $request)
    {
        $setting = $this->settingRepository->settingFindById($request->settingID);
        $content = '';
        $content = ' <div class="modal-body"><div class="row"><div class="col-md-1 mb-3"></div><div class="col-md-10 mb-3">';
        $content .= '<label class="col-form-label"> متن </label><br>'.$setting->str_value.'</div> </div>';
        return response()->json([
            'content' => $content,
        ]);
    }

}

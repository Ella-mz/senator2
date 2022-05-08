<?php

namespace Modules\Ad\Http\Controllers\Admin\Ad;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Modules\Ad\Http\Requests\User\UpdateRequest;
use Modules\Ad\Repositories\AdRepository;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\City\Repositories\CityRepository;
use Modules\Map\Traits\NeshanTrait;
use Modules\Neighborhood\Repositories\NeighborhoodRepository;
use Modules\Setting\Repository\AdminSettingRepository;
use Modules\Setting\Repository\SettingRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class EditController extends Controller
{
    use GetGroupAttributeTrait, NeshanTrait;
    use UploadFileTrait;

    private $adRepository;
    private $settingRepository;
    private $adminSettingRepository;
    private $cityRepository;
    private $neighborhoodRepository;

    public function __construct(AdRepository $adRepository, SettingRepository $settingRepository,
                                AdminSettingRepository $adminSettingRepository, CityRepository $cityRepository,
                                NeighborhoodRepository $neighborhoodRepository)
    {
        $this->adRepository = $adRepository;
        $this->settingRepository = $settingRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->cityRepository = $cityRepository;
        $this->neighborhoodRepository = $neighborhoodRepository;
    }

    /**
     * @param $adId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($adId)
    {
        \session(['backInAdmin' => URL::previous()]);
        $hasSpecial = $this->adminSettingRepository->getAdminSettingByTitle('hasSpecial')->value;
        $hasScalar = $this->adminSettingRepository->getAdminSettingByTitle('hasScalar')->value;
        $hasEmergency = $this->adminSettingRepository->getAdminSettingByTitle('hasEmergency')->value;
        $ad = $this->adRepository->adFindById($adId);
        $cities = $this->cityRepository->all();
        $neighborhoods = $this->neighborhoodRepository->all();
        $attributeGroups = $this->getAttributeGroups($ad->category_id, 'supplier');
        $content = '';
        $imageOfUploadVideo = $this->settingRepository->getSettingByTitle('video_image_for_display_in_upload')->str_value;
        $api_key = $this->neshan_get_api_key();
        $sdk_key = $this->neshan_get_SDK_key();
        $latitude = $ad->latitude;
        $longitude = $ad->longitude;
        $mapCenter=[];
        if (isset($this->settingRepository->getSettingByTitle('latitude')->str_value) && isset($this->settingRepository->getSettingByTitle('longitude')->str_value))
            $mapCenter = [(float)$this->settingRepository->getSettingByTitle('latitude')->str_value, (float)$this->settingRepository->getSettingByTitle('longitude')->str_value];


        return view('Ads::admin.editSinglePage', compact('ad', 'cities', 'neighborhoods', 'attributeGroups',
            'hasSpecial', 'hasEmergency', 'hasScalar', 'content', 'imageOfUploadVideo', 'sdk_key', 'api_key',
            'latitude', 'longitude', 'mapCenter'));
    }

    /**
     * @param UpdateRequest $request
     * @param $adId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateRequest $request, $adId)
    {
        $ad = $this->adRepository->adFindById($adId);
        if ($request->attribute != null) {
            foreach ($request->attribute as $key => $attribute) {
                if (!isset($attribute['alt'])) {
                    if ($this->adRepository->findAttributeById($key)->isFilterField == 1 && ($attribute['main'] == null)
                        && ($this->adRepository->findAttributeById($key)->attribute_type != 'bool')) {
                        return back()->with('message2', 'مشخصه  ' . $this->adRepository->findAttributeById($key)->title . ' الزامی است.')->withInput();
                    }
                }
            }

            foreach ($request->attribute as $key => $attribute) {
                if ($this->adRepository->findAttributeById($key)->isFilterField == 1) {
                    if (!isset($attribute['alt'])) {
                        if ($this->adRepository->findAttributeById($key)->attribute_type == 'int'
                            && (!is_numeric(str_replace(',', '', $attribute['main'])))) {
                            return back()->with('message3', 'مشخصه  ' . $this->adRepository->findAttributeById($key)->title . ' باید به صورت عدد وارد شود است.')->withInput();
                        }
                    }
                } else {
                    if (isset($attribute['main']) && $attribute['main'] != null) {
                        if ($this->adRepository->findAttributeById($key)->attribute_type == 'int' && (!is_numeric(str_replace(',', '', $attribute['main'])))) {
                            return back()->with('message3', 'مشخصه  ' . $this->adRepository->findAttributeById($key)->title . ' باید به صورت عدد وارد شود است.')->withInput();
                        }
                    }
                }
            }
        }
        $ad = $this->adRepository->updateAdWithAttrsAndImages($request, $ad, auth()->user());
        $ad->update([
            'active'=>'active'
        ]);
        \alert()->success('', 'آگهی با موفقیت ویرایش شد');
        return redirect(\url(session('backInAdmin')));
    }
}

<?php

namespace Modules\Ad\Http\Controllers\Admin\Ad;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Modules\Ad\Http\Requests\User\StoreRequest;
use Modules\Ad\Repositories\CatalogRepository;
use Modules\Ad\Traits\StoreSupplierAdTrait;
use Modules\Ad\Repositories\AdRepository;
use Modules\Attribute\Entities\Attribute;
use Modules\Map\Traits\NeshanTrait;
use Modules\Setting\Repository\AdminSettingRepository;
use Modules\Setting\Repository\SettingRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;
use RealRashid\SweetAlert\Facades\Alert;

class CreateController extends Controller
{
    use GetGroupAttributeTrait, StoreSupplierAdTrait, NeshanTrait;

    private $repo;
    private $settingRepository;
    private $adminSettingRepository;
    private $catalogRepository;

    public function __construct(AdRepository $adRepository, SettingRepository $settingRepository,
                                AdminSettingRepository $adminSettingRepository, CatalogRepository $catalogRepository)
    {
        $this->repo = $adRepository;
        $this->settingRepository = $settingRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * @param $categoryId
     * @return View
     */
    public function index($categoryId): View
    {
        $hasSpecial = $this->repo->adminSetting('hasSpecial');
        $hasScalar = $this->repo->adminSetting('hasScalar');
        $hasEmergency = $this->repo->adminSetting('hasEmergency');

        $category = $this->repo->findCategoryById($categoryId);
        $cities = $this->repo->cities();
        $attributeGroups = $this->getAttributeGroups($category->id, 'supplier');
        $grandCategory_id = $category->getGrandParent();
        $content = '';
        $attributeGroups = $attributeGroups->whereIn('advertiser', ['supplier', 'both'])
            ->pluck('id')->toArray();

        $attributeGroups = $this->repo->attributeGroupsById($attributeGroups);
        $imageOfUploadVideo = $this->settingRepository->getSettingByTitle('video_image_for_display_in_upload')->str_value;
        $api_key = $this->neshan_get_api_key();
        $sdk_key = $this->neshan_get_SDK_key();
        $latitude = null;
        $longitude = null;
        $mapCenter=[];
        if (isset($this->settingRepository->getSettingByTitle('latitude')->str_value) && isset($this->settingRepository->getSettingByTitle('longitude')->str_value))
            $mapCenter = [(float)$this->settingRepository->getSettingByTitle('latitude')->str_value, (float)$this->settingRepository->getSettingByTitle('longitude')->str_value];


        return view('Ads::admin.createSinglePage',
            compact('cities', 'category', 'attributeGroups', 'content', 'hasSpecial',
                'hasEmergency', 'hasScalar', 'imageOfUploadVideo', 'sdk_key', 'api_key', 'mapCenter', 'latitude', 'longitude'));
    }

    public function store(StoreRequest $request, $categoryId)
    {
        $category = $this->repo->findCategoryById($categoryId);
        $duration_of_ads = $this->settingRepository->getSettingByTitle('duration_of_ads')->str_value;

        if ($request->attribute != null) {
            foreach ($request->attribute as $key => $attribute) {
                if (!isset($attribute['alt'])) {
                    if (Attribute::where('id', $key)->first()->isFilterField == 1 && ($attribute['main'] == null)
                    && (Attribute::where('id', $key)->first()->attribute_type != 'bool')) {
                        return back()->with('message2', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' الزامی است.')->withInput();
                    }
                }
            }

            foreach ($request->attribute as $key => $attribute) {
                if (Attribute::where('id', $key)->first()->isFilterField == 1) {
                    if (!isset($attribute['alt'])) {
                        if (Attribute::where('id', $key)->first()->attribute_type == 'int'
                            && (!is_numeric(str_replace(',', '', $attribute['main'])))) {
                            return back()->with('message3', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' باید به صورت عدد وارد شود است.')->withInput();
                        }
                    }
                } else {
                    if (isset($attribute['main']) && $attribute['main'] != null) {
                        if (Attribute::where('id', $key)->first()->attribute_type == 'int' && (!is_numeric(str_replace(',', '', $attribute['main'])))) {
                            return back()->with('message3', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' باید به صورت عدد وارد شود است.')->withInput();
                        }
                    }
                }
            }
        }
        $ad = $this->storeAdWithAttrsAndImages($request->all(), $category);
        if (isset($request->catalog))
            $this->catalogRepository->uploadCatalog($ad, $request, \auth()->user());
        $ad->update([
            'paymentType' => 'admin',
            'isPaid' => 'paid',
            'active' => 'active',
            'endDate' => Carbon::now()->add($duration_of_ads, 'day')
        ]);
        Alert::success('', 'آگهی با موفقیت ثبت شد');
        return redirect(route('ad.index.supplier.admin', $ad->active));
    }

}

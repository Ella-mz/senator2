<?php

namespace Modules\Ad\Http\Controllers\User\Ad;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Repositories\AdRepository;
use Modules\Ad\Repositories\CatalogRepository;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\Bookmark\Entities\Bookmark;
use Modules\Map\Traits\NeshanTrait;
use Modules\Recentseen\Entities\Recentseen;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Repositories\UserRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class ShowController extends Controller
{
    use GetGroupAttributeTrait, NeshanTrait;

    public $repo;
    private $advertisingRepository;
    private $advertisingApplicationRepository;
    private $settingRepository;
    private $userRepository;
    private $catalogRepository;

    public function __construct(AdRepository $adRepository, AdvertisingRepository            $advertisingRepository,
                                AdvertisingApplicationRepository $advertisingApplicationRepository, SettingRepository $settingRepository,
                                UserRepository $userRepository, CatalogRepository $catalogRepository)
    {
        $this->repo = $adRepository;
        $this->advertisingRepository = $advertisingRepository;
        $this->advertisingApplicationRepository = $advertisingApplicationRepository;
        $this->settingRepository = $settingRepository;
        $this->userRepository = $userRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * @param $adId
     */

    public function show($adId)
    {
        $ad = $this->repo->adFindById($adId);
        if (!$ad)
            return redirect()->back();
        if (\auth()->check()) {
            if (\auth()->id()!=$ad->user_id){
                $x = $ad->viewCount + 1;
                $ad->update(['viewCount' => $x,]);
            }
            if (Recentseen::where('ad_id', $ad->id)->where('user_id', \auth()->id())->first() == null) {
                $r = Recentseen::create([
                    'user_id' => \auth()->id(),
                    'ad_id' => $ad->id,
                ]);
            }
        }else{
            $x = $ad->viewCount + 1;
            $ad->update(['viewCount' => $x,]);
        }
        $similarAds = $this->repo->similarAds($adId);
        $adsOfUser = $this->repo->adsOfUser($ad->user_id)->where('id', '!=', $ad->id)->take(5)->get();
        $user = $this->userRepository->userFindById($ad->user_id);
        $api_key = $this->neshan_get_api_key();
        $sdk_key = $this->neshan_get_SDK_key();
        $latitude=$ad->latitude;
        $longitude=$ad->longitude;
        $mapCenter=[];
        if (isset($latitude) && isset($longitude))
            $mapCenter = [(float)$latitude, (float)$longitude];
        $ad_phone_number = $this->settingRepository->getSettingByTitle('general_phone_number_of_ads')->str_value;

        $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('AdDetailPage');
        $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
        return view('Ads::user.ad.show.show', compact('ad', 'similarAds', 'latitude', 'longitude',
            'advertisement', 'adsOfUser', 'mapCenter', 'sdk_key', 'api_key', 'user', 'ad_phone_number'));
    }

    public function myAds()
    {
        $posts = Ad::where('user_id', \auth()->id())->where('advertiser', 'supplier')
            ->orderByDesc('created_at')->paginate(8);
        $ad_default_photo = $this->settingRepository->getSettingByTitle('ad_default_photo')->str_value;
        $emergency_default_photo = $this->settingRepository->getSettingByTitle('emergency_label')->str_value;
        return view('Ads::user.ad.show.myPosts', compact('posts',
            'ad_default_photo', 'emergency_default_photo'));
    }

    public function bookmark()
    {
        $bookmarks = Bookmark::where('user_id', \auth()->id())->where('status', 1)
            ->orderByDesc('created_at')->paginate(8);
        $ad_default_photo = $this->settingRepository->getSettingByTitle('ad_default_photo')->str_value;
        $emergency_default_photo = $this->settingRepository->getSettingByTitle('emergency_label')->str_value;
        return view('Ads::user.ad.show.bookmarks', compact('bookmarks',
            'ad_default_photo', 'emergency_default_photo'));
    }

    public function recentseens()
    {
        $recentseens = Recentseen::where('user_id', \auth()->id())
            ->orderByDesc('created_at')->paginate(8);
        $ad_default_photo = $this->settingRepository->getSettingByTitle('ad_default_photo')->str_value;
        $emergency_default_photo = $this->settingRepository->getSettingByTitle('emergency_label')->str_value;
        return view('Ads::user.ad.show.recentseens', compact('recentseens',
            'ad_default_photo', 'emergency_default_photo'));
    }

    public function userAds($userId)
    {
        $user = $this->userRepository->userFindByUserId($userId);
        $ads = $this->repo->adsOfUser($user->id)->paginate(40);
        $ad_default_photo = $this->settingRepository->getSettingByTitle('ad_default_photo')->str_value;
        $emergency_default_photo = $this->settingRepository->getSettingByTitle('emergency_label')->str_value;
        return view('Ads::user.ad.show.userAds', compact('ads', 'user',
            'ad_default_photo', 'emergency_default_photo'));
    }

    public function downloadCatalog($catalogId)
    {
        return $this->catalogRepository->download($catalogId);
    }
}

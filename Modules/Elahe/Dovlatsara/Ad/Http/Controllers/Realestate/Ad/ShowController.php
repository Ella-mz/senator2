<?php

namespace Modules\Ad\Http\Controllers\Realestate\Ad;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Repositories\AdRepository;
use Modules\Ad\Repositories\CatalogRepository;
use Modules\Bookmark\Entities\Bookmark;
use Modules\Map\Traits\NeshanTrait;
use Modules\Recentseen\Entities\Recentseen;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Repositories\UserRepository;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class ShowController extends Controller
{
    use GetGroupAttributeTrait, NeshanTrait;

    private $adRepository;
    private $userRepository;
    private $settingRepository;
    private $catalogRepository;

    public function __construct(AdRepository $adRepository, UserRepository $userRepository,
                                SettingRepository $settingRepository, CatalogRepository $catalogRepository)
    {
        $this->adRepository = $adRepository;
        $this->userRepository = $userRepository;
        $this->settingRepository = $settingRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * @param $userId
     * @return View
     */
    public function index($userId, $type): View
    {
        $content = '';
        $ads = null;
        $user = $this->userRepository->userFindById($userId);
        if ($type == 'my-ads') {
            $content = 'ی من';
            $ads = Ad::where('advertiser', 'supplier')
                ->where('user_id', $user->id)
                ->where('agency_id', null)
                ->orderByDesc('created_at')->get();
        } elseif ($type == 'my-ads-in-agency') {
            $content = 'ی من در آژانس';
            $ads = Ad::where('advertiser', 'supplier')
                ->where('user_id', $user->id)
                ->where('agency_id', $user->hasRole('real-state-agent') ? $user->real_estate_admin_id : $user->id)
                ->orderByDesc('created_at')->get();
        } elseif ($type == 'ads-of-agency') {
            $content = 'ی آژانس';
            $ads = Ad::where('advertiser', 'supplier')
                ->where('agency_id', $user->id)
                ->orderByDesc('created_at')->get();
        }
//            if ($user->hasRole('real-state-agent')) {
//                $ads = Ad::where('advertiser', 'supplier')
//                    ->where('agency_id', $user->id)
//                    ->where('isPaid', 'paid')
//                    ->whereIn('request_to_agency', ['approved', 'noRequest'])
//                    ->orderByDesc('created_at')->get();
//            } else {
//                $user_ids = User::where('real_estate_admin_id', $user->id)->pluck('id')->toArray();
//                array_push($user_ids, $user->id);
//                $ads = Ad::where('advertiser', 'supplier')->whereIn('user_id', $user_ids)->orderByDesc('created_at')->get();
//            }
        return view('Ads::realestate.index', compact('ads', 'type', 'user', 'content'));
    }

    /**
     * @param $adId
     * @return View
     */
    public function show($adId): View
    {
        $ad = $this->adRepository->adFindById($adId);

        $api_key = $this->neshan_get_api_key();
        $sdk_key = $this->neshan_get_SDK_key();
        $latitude = $ad->latitude;
        $longitude = $ad->longitude;
        $mapCenter = [];
        if (isset($latitude) && isset($longitude))
            $mapCenter = [(float)$latitude, (float)$longitude];

        return view('Ads::realestate.show', compact('ad', 'latitude', 'longitude', 'mapCenter', 'sdk_key', 'api_key'));
    }

    public function bookmarks()
    {
        $bookmarks = Bookmark::where('user_id', \auth()->id())->where('status', 1)
            ->orderByDesc('created_at')->get();
        return view('Ads::realestate.bookmarks', compact('bookmarks'));
    }

    public function recentseens()
    {
        $recentseens = Recentseen::where('user_id', \auth()->id())
            ->orderByDesc('created_at')->get();
        return view('Ads::realestate.recentseens', compact('recentseens'));
    }

    public function postedSpecificAgency($agencyId)
    {
        $adminOfAgency = $this->userRepository->userFindById($agencyId);
        $ads = $this->adRepository->postedAdsForSpecificAgency($adminOfAgency);
        return view('Ads::realestate.postedSpecificAgency', compact('ads'));

    }

    public function postedAgencies()
    {
//        $adminOfAgency = $this->userRepository->userFindById($agencyId);
        $ads = $this->adRepository->postedAdsForAgencies(auth()->user());
        return view('Ads::realestate.postedAgencies', compact('ads'));
    }

    public function downloadCatalog($catalogId)
    {
        return $this->catalogRepository->download($catalogId);
    }
}

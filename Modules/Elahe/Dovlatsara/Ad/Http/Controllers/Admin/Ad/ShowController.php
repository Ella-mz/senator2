<?php

namespace Modules\Ad\Http\Controllers\Admin\Ad;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Repositories\AdRepository;
use Modules\Ad\Repositories\CatalogRepository;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Repositories\CityRepository;
use Modules\Map\Traits\NeshanTrait;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\UserMasterNew\Http\Traits\GetGroupAttributeTrait;

class ShowController extends Controller
{
    use GetGroupAttributeTrait, NeshanTrait;

    private $adRepository;
    private $categoryRepository;
    private $cityRepository;
    private $catalogRepository;

    public function __construct(AdRepository $adRepository, CategoryRepository $categoryRepository,
                                CityRepository $cityRepository, CatalogRepository $catalogRepository)
    {
        $this->adRepository = $adRepository;
        $this->categoryRepository = $categoryRepository;
        $this->cityRepository = $cityRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * @param $active
     * @return View
     */
    public function index(Request $request, $active): View
    {
        $paginate = 50;
        $tags = [];
        if ($active == 'expire')
            $ads = Ad::where('advertiser', 'supplier')
                ->endDateSmallerThan(Carbon::now())->orderByDesc('created_at');
        else
            $ads = Ad::where('advertiser', 'supplier')
                ->where('active', $active)->endDateGreaterThan(Carbon::now())->orderByDesc('created_at');
        $categories = $this->categoryRepository->nodeCategories();
        $cities = $this->cityRepository->all();

        if ($request->t == 1 && (isset($request->category) || isset($request->neighborhood) || isset($request->city)
                || (isset($request->type)) || (isset($request->isPaid)) || (isset($request->search)))) {
            if (isset($request->category)) {
                $ads = $ads->where('category_id', $request->category);
                $tags['category'] = $this->categoryRepository->categoryFindById($request->category)->createStringAsParents();
            }
            if (isset($request->city)) {
                $ads = $ads->where('city_id', $request->city);
                $tags['city'] = $this->cityRepository->cityFindById($request->city)->title;
            }
            if (isset($request->neighborhood)) {
                $ads = $ads->where('neighborhood_id', $request->neighborhood);
                $tags['neighborhood'] = Neighborhood::find($request->neighborhood)->title;
            }
            if (isset($request->search)) {
                $tag = $request->search;
                $ads = Ad::where(function ($query) use ($tag) {
                    $query->where('title', 'LIKE', '%' . $tag . '%');
                })->orWhere(function ($query) use ($tag) {
                    $query->where('uniqueCodeOfAd', 'LIKE', '%' . $tag . '%');
                });
//                $ads = $ads->where('neighborhood_id', $request->neighborhood);
                $tags['search'] = $tag;
            }
            if (isset($request->type)) {
                $ads = $ads->where('type', $request->type);
                if ($request->type == 'general')
                    $tags['type'] = 'عادی';
                elseif ($request->type == 'scalar')
                    $tags['type'] = 'نردبانی';
                elseif ($request->type == 'emergency')
                    $tags['type'] = 'فوری';
            }
            if (isset($request->isPaid)) {
                $ads = $ads->where('isPaid', $request->isPaid);
                if ($request->isPaid == 'paid')
                    $tags['isPaid'] = 'پرداخت شده';
                elseif ($request->isPaid == 'unpaid')
                    $tags['isPaid'] = 'پرداخت نشده';
            }
            $ads_ids = $ads->pluck('id')->toArray();
            $ads = Ad::whereIn('id', $ads_ids)->orderByDesc('created_at')->paginate($paginate);

            return view('Ads::admin.index', compact('ads', 'tags', 'active', 'categories', 'cities', 'paginate'));
        }
        $ads = $ads->paginate($paginate);
        return view('Ads::admin.index', compact('ads', 'tags', 'active', 'categories', 'cities', 'paginate'));
    }

    public function show(Ad $ad)
    {
        $api_key = $this->neshan_get_api_key();
        $sdk_key = $this->neshan_get_SDK_key();
        $latitude=$ad->latitude;
        $longitude=$ad->longitude;
        $mapCenter=[];
        if (isset($latitude) && isset($longitude))
            $mapCenter = [(float)$latitude, (float)$longitude];

        return view('Ads::admin.show', compact('ad', 'latitude', 'longitude', 'mapCenter', 'sdk_key', 'api_key'));
    }

    public function approve(Ad $ad)
    {
        if ($ad) {
            $ad->update([
                'active' => 'active',
                'startDate' => Carbon::now()
            ]);
            return redirect()->back();
        } else
            return back();
    }

    public function disconfirm()
    {
        $ad = Ad::find(request('adid'));
        if ($ad) {
            $ad->update([
                'active' => 'disConfirm',
                'deactivationReason' => request('adreason'),
            ]);
            alert()->success('', 'با موفقیت ثبت شد');
            return redirect()->back();
        } else {
            alert()->error('', 'آگهی موجود نیست');
            return redirect()->back();
        }
    }

    public function downloadCatalog($catalogId)
    {
        return $this->catalogRepository->download($catalogId);
    }
}

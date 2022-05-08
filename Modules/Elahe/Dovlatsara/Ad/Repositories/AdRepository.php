<?php

namespace Modules\Ad\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Entities\AdVideo;
use Modules\AdFee\Entities\AdFee;
use Modules\AdImageNew\Entities\AdImageNew;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Attribute\Entities\Attribute;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Entities\City;
use Modules\GroupAttribute\Entities\GroupAttribute;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\Setting\Entities\AdminSetting;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Repository\AdminSettingRepository;
use Modules\Setting\Repository\SettingRepository;
use Modules\User\Repositories\UserRepository;

class AdRepository
{
    private $categoryRepository;
    private $adminSettingRepository;
    private $settingRepository;
    private $userRepository;

    public function __construct(CategoryRepository $categoryRepository, AdminSettingRepository $adminSettingRepository,
                                SettingRepository $settingRepository, UserRepository $userRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->adminSettingRepository = $adminSettingRepository;
        $this->settingRepository = $settingRepository;
        $this->userRepository = $userRepository;
    }

    use UploadFileTrait;

    /**
     * @param $id
     * @return mixed
     */
    public function adFindById($id)
    {
        return Ad::find($id);
    }

    /**
     * @param $ids
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function attributeGroupsById($ids)
    {
        return GroupAttribute::with('attributes')->whereIn('id', $ids)->orderBy('order', 'asc')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findCategoryById($id)
    {
        return $this->categoryRepository->categoryFindById($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|City[]
     */
    public function cities()
    {
        return City::all();
    }

    /**
     * @return mixed
     */
    public function categoriesDepth1()
    {
        return Category::where('depth', 1)->get();
    }

    /**
     * @param $category
     * @return mixed
     */
    public function getSubCategories($category)
    {
        return $category->categories()->get();
    }

    /**
     * @param $category
     * @return mixed
     */
    public function getParentCategory($category)
    {
        return $category->category()->first();
    }

    /**
     * @param $item
     * @return mixed
     */
    public function adminSetting($item)
    {
        return AdminSetting::where('title', $item)->first()->value;
    }

    /**
     * @param $item
     * @return mixed
     */
    public function setting($item)
    {
        return Setting::where('title', $item)->first()->str_value;
    }

    /**
     * @param $adId
     * @return mixed
     */
    public function similarAds($adId)
    {
        $ad = $this->adFindById($adId);
        if ($ad->request_to_agency == 'approved')
            $ads = Ad::with('attributes')
                ->active('active')
                ->endDateGreaterThan(Carbon::now())
                ->advertiser('supplier')
                ->userStatus('active')
                ->isPaid('paid')
                ->city($ad->city_id)
                ->category($ad->category_id)
                ->where('id', '!=', $ad->id)
                ->agency($ad->agnecy_id)
                ->orderByDesc('created_at');
        else
            $ads = Ad::with('attributes')
                ->active('active')
                ->endDateGreaterThan(Carbon::now())
                ->advertiser('supplier')
                ->userStatus('active')
                ->isPaid('paid')
                ->city($ad->city_id)
                ->category($ad->category_id)
                ->where('id', '!=', $ad->id)
                ->orderByDesc('created_at');
        if (session('cities'))
            $ads = $ads->whereIn('city_id', session('cities'));
        return $ads->paginate(10);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function adFeeFindById($id)
    {
        return AdFee::find($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Neighborhood[]
     */
    public function neighborhoods()
    {
        return Neighborhood::all();
    }

    /**
     * @param $ad
     * @param $image
     * @return mixed
     */
    public function createAdImage($ad, $image)
    {
        return AdImageNew::create([
            'ad_id' => $ad->id,
            'image' => $image,
            'created_user' => \auth()->id(),
        ]);
    }

    /**
     * @param $ad
     * @param $video
     * @return mixed
     */
    public function createAdVideo($ad, $video)
    {
        return AdVideo::create([
            'ad_id' => $ad->id,
            'video' => $video,
            'created_user' => \auth()->id(),
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findAttributeById($id)
    {
        return Attribute::find($id);
    }

    /**
     * @param $request
     * @param $ad
     * @param $user
     * @return mixed
     */
    public function updateAdWithAttrsAndImages($request, $ad, $user)
    {
        $typeOfWatermark = $this->adminSettingRepository->getAdminSettingByTitle('ads_type_of_watermark')->value;
        $watermark = $this->settingRepository->getSettingByTitle('watermark_for_ads')->str_value;

        $ad->update([
//            'category_id' => $category->id,
            'neighborhood_id' => $request->neighborhood,
            'city_id' => $request->city,
            'title' => $request->title,
            'description' => $request->description,
//            'type' => $request->adType,
            'advertiser' => 'supplier',
//            'startDate' => Carbon::now(),
            'mobile' => isset($user->phoneNumberForAds) ? $user->phoneNumberForAds : $user->mobile,
            'active' => 'inactive',
            'userStatus' => 'active',
            'longitude' => $request->longg,
            'latitude' => $request->latt,
            'address' => $request->address,
            'hasChat' => $request->hasChat ? 1 : 0,
            'updated_user' => $user->id,
            'request_to_agency' => $request->request_to_agency ? 'pending' : 'noRequest',
        ]);
        if ($ad->type == 'scalar')
            $ad->update(['priority' => 1,]);
        else
            $ad->update(['priority' => 2,]);
        if (isset($request->attribute))
            $this->attrss($request->attribute, $ad, $user);
        if ($user->hasRole('real-state-agent'))
            $text = $this->userRepository->userFindById($user->real_estate_admin_id)->slug;
        elseif ($user->hasRole('real-state-administrator'))
            $text = $user->slug;
        else
            $text = null;

        if (isset($request->adImage)) {
            foreach ($request->adImage as $key => $image) {
                if ($image != null) {
                    if (str_contains($image->getClientMimeType(), 'video')) {
                        $im = $this->uploadFile($image, 'public/upload/adImages/' . now()->year
                            . '/' . now()->month . '/' . $ad->id);
                        AdVideo::create([
                            'ad_id' => $ad->id,
                            'video' => $im,
                            'created_user' => $user->id,
                        ]);
                    } else {
                        if ($typeOfWatermark == 'ImageAndText') {
                            $im = $this->uploadFileWithImageAndTextWatermark($image, 'public/upload/adImages/' . now()->year
                                . '/' . now()->month . '/' . $ad->id, $watermark, $text, $request['color']);
                        } elseif ($typeOfWatermark == 'Image') {
                            $im = $this->uploadFileWithImageWatermark($image, 'public/upload/adImages/' . now()->year
                                . '/' . now()->month . '/' . $ad->id, $watermark);
                        } elseif ($typeOfWatermark == 'Text') {
                            $im = $this->uploadFileWithTextWatermark($image, 'public/upload/adImages/' . now()->year
                                . '/' . now()->month . '/' . $ad->id, $text, $request['color']);
                        } else {
                            $im = $this->uploadFile($image, 'public/upload/adImages/' . now()->year
                                . '/' . now()->month . '/' . $ad->id);
                        }
                        AdImageNew::create([
                            'ad_id' => $ad->id,
                            'image' => $im,
                            'created_user' => $user->id,
                        ]);
                    }
                }
            }
        }

//        if (isset($request->adImage)) {
//            foreach ($request->adImage as $key => $image) {
//                if ($image != null) {
//                    $im = $this->uploadFile($image, 'public/upload/adImages/' . now()->year
//                        . '/' . now()->month . '/' . $ad->id);
//                    if ($key == 6) {
//                        $this->createAdVideo($ad, $im);
//                    } else
//                        $this->createAdImage($ad, $im);
//                }
//            }
//        }
        return $ad;
    }

    /**
     * @param $request
     * @param $ad
     * @param $user
     */
    public function attrss($request, $ad, $user)
    {
        $ad->attributes()->detach();
        foreach ($request as $key => $attribute) {
            if ($this->findAttributeById($key)->attribute_type == 'select') {
                if ($attribute['main'] != null)
                    $ad->attributes()->attach($key, [
                        'attribute_item_id' => $attribute['main'],
                        'created_user' => $user->id,
                    ]);
            } elseif ($this->findAttributeById($key)->attribute_type == 'int') {
                if (isset($attribute['alt'])) {
                    $ad->attributes()->attach($key, [
                        'alt_value' => 1,
                        'created_user' => $user->id,
                    ]);
                } else {
                    if ($attribute['main'] != null)
                        $ad->attributes()->attach($key, [
                            'value' => str_replace(',', '', $attribute['main']),
                            'created_user' => $user->id,
                        ]);
                }
            } elseif ($this->findAttributeById($key)->attribute_type == 'bool') {
                if ($attribute['main'] != null)
                    $ad->attributes()->attach($key, [
                        'value' => 1,
                        'created_user' => $user->id,
                    ]);
            } else {
                if ($attribute['main'] != null)
                    $ad->attributes()->attach($key, [
                        'value' => $attribute['main'],
                        'created_user' => $user->id,
                    ]);
            }
        }
    }

    /**
     * @param $category
     * @param $nodes
     * @param $user_ids
     * @param $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function adsOfAgency($category, $nodes, $user_ids, $user): \Illuminate\Database\Eloquent\Builder
    {
        return Ad::with('attributes')
            ->whereIn('category_id', $category ? $category->allNodesIds() : $nodes)
            ->where('agency_id', $user->id)
            ->isPaid('paid')
            ->active('active')
            ->userStatusNotEqualTo('inactive')
            ->endDateGreaterThan(Carbon::now())
            ->advertiser('supplier')
            ->whereIn('request_to_agency', ['approved', 'noRequest']);
//            ->where(function ($query) use ($category, $nodes, $user) {
//                $query->whereIn('category_id', $category ? $category->allNodesIds() : $nodes)
//                    ->where('agency_id', $user->id)
//                    ->isPaid('paid')
//                    ->active('active')
//                    ->userStatusNotEqualTo('inactive')
//                    ->endDateGreaterThan(Carbon::now())
//                    ->advertiser('supplier')
//                    ->requestToAgency('approved');
//            })->orWhere(function ($query) use ($category, $nodes, $user) {
//                $query->whereIn('category_id', $category ? $category->allNodesIds() : $nodes)
//                    ->where('agency_id', $user->id)
//                    ->isPaid('paid')
//                    ->active('active')
//                    ->userStatusNotEqualTo('inactive')
//                    ->endDateGreaterThan(Carbon::now())
//                    ->advertiser('supplier')
//                    ->requestToAgency('noRequest');
//            });
    }

    /**
     * @param $adminOfAgency
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function postedAdsForSpecificAgency($adminOfAgency)
    {
        $nodes = $this->categoryRepository->nodeIds();
        return Ad::with('attributes')
            ->where(function ($query) use ($nodes, $adminOfAgency) {
                $query->whereIn('category_id', isset($adminOfAgency->category_id) ? $this->categoryRepository->categoryFindById($adminOfAgency->category_id)->allNodesIds() : $nodes)
                    ->where('agency_id', $adminOfAgency->id)
                    ->advertiser('supplier')
                    ->endDateGreaterThan(Carbon::now())
                    ->active('active')
                    ->isPaid('paid')
                    ->requestToAgency('pending');
            })->orWhere(function ($query) use ($nodes, $adminOfAgency) {
                $query->whereIn('category_id', isset($adminOfAgency->category_id) ? $this->categoryRepository->categoryFindById($adminOfAgency->category_id)->allNodesIds() : $nodes)
                    ->where('agency_id', $adminOfAgency->id)
                    ->advertiser('supplier')
                    ->endDateGreaterThan(Carbon::now())
                    ->active('active')
                    ->isPaid('paid')
                    ->requestToAgency('approved');
            })->orderByDesc('created_at')->get();
    }

    /**
     * @param $user
     * @return mixed
     */
    public function postedAdsForAgencies($user)
    {
        $category = null;
        if ($user->hasRole('real-state-administrator'))
            $category = $this->categoryRepository->categoryFindById($user->category_id);
        elseif ($user->hasRole('real-state-agent'))
            $category = $this->categoryRepository->categoryFindById($this->userRepository->userFindById($user->real_estate_admin_id)->category_id);
        $nodes = $this->categoryRepository->nodeIds();
        return Ad::with('attributes')
            ->whereIn('category_id', $category ? $category->allNodesIds() : $nodes)
            ->advertiser('supplier')
            ->endDateGreaterThan(Carbon::now())
            ->active('active')
            ->isPaid('paid')
            ->requestToAgency('pending')->get();
    }

    /**
     * @param $adIds
     * @return \Illuminate\Support\Collection
     */
    public function adAttributeWithAdIds($adIds)
    {
        return DB::table('ad_attribute')->whereIn('ad_id', $adIds)->get();
    }

    /**
     * @param $adIds
     * @return mixed
     */
    public function adsFindByIds($adIds)
    {
        return Ad::whereIn('id', $adIds)->orderByDesc('created_at')->get();
    }

    /**
     * @param $adId
     * @param $userId
     * @return bool
     */
    public function delete($adId, $userId)
    {
        $ad = $this->adFindById($adId);
        $ad->update(['deleted_user'=>$userId]);
        $ad->delete();
        return true;
    }

    /**
     * @param $adId
     * @return bool
     */
    public function deleteByUser($adId)
    {
        $ad = $this->adFindById($adId);
        $ad->update([
            'active'=>'delete'
        ]);
        return true;
    }

    /**
     * @param $adId
     * @param $arg
     * @return bool
     */
    public function updateUserStatus($adId, $arg)
    {
        $ad = $this->adFindById($adId);
        $ad->update([
            'userStatus'=> $arg
        ]);
        return true;
    }

    public function adsOfHomePage()
    {
        return Ad::with('attributes')
            ->where('active', 'active')
            ->where('endDate', '>', Carbon::now())
            ->where('advertiser', 'supplier')
            ->where('userStatus', 'active')
            ->where('isPaid', 'paid')
            ->orderByDesc('created_at');
    }

    public function adsOfUser($userId)
    {
        return Ad::with('attributes')
            ->user($userId)
            ->active('active')
            ->endDateGreaterThan(Carbon::now())
            ->advertiser('supplier')
            ->userStatus('active')
            ->isPaid('paid')
            ->orderByDesc('created_at');
    }
}

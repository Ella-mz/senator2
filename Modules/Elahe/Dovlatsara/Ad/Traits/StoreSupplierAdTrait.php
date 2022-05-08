<?php namespace Modules\Ad\Traits;

use Carbon\Carbon;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Entities\AdVideo;
use Modules\AdImageNew\Entities\AdImageNew;
use Modules\AdminMasterNew\Http\Traits\UploadFileTrait;
use Modules\Attribute\Entities\Attribute;
use Modules\User\Entities\User;

trait StoreSupplierAdTrait
{
    use UploadFileTrait;

    public function convertToEnglish($string)
    {
        if (!$string)
            return null;

        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);
    }

    public function attrss($request, $ad)
    {
        foreach ($request as $key => $attribute) {
            if (Attribute::where('id', $key)->first()->attribute_type == 'select') {
                if ($attribute['main'] != null)
                    $ad->attributes()->attach($key, [
                        'attribute_item_id' => $attribute['main'],
                        'created_user' => \auth()->id(),
                    ]);
            } elseif (Attribute::where('id', $key)->first()->attribute_type == 'int') {
                if (isset($attribute['alt'])) {
                    $ad->attributes()->attach($key, [
                        'alt_value' => 1,
                        'created_user' => \auth()->id(),
                    ]);
                } else {
                    if ($attribute['main'] != null)
                        $ad->attributes()->attach($key, [
                            'value' => $this->convertToEnglish(str_replace(',', '', $attribute['main'])),
                            'created_user' => \auth()->id(),
                        ]);
                }
            } elseif (Attribute::where('id', $key)->first()->attribute_type == 'bool') {
                if ($attribute == 'on') {
                    if ($attribute['main'] != null)
                        $ad->attributes()->attach($key, [
                            'value' => 1,
                            'created_user' => \auth()->id(),
                        ]);
                }
            } else {
                if ($attribute['main'] != null)
                    $ad->attributes()->attach($key, [
                        'value' => $attribute['main'],
                        'created_user' => \auth()->id(),
                    ]);
            }
        }
    }

    public function storeAdWithAttrsAndImages($request, $category)
    {
        $typeOfWatermark = $this->adminSettingRepository->getAdminSettingByTitle('ads_type_of_watermark')->value;
        $watermark = $this->settingRepository->getSettingByTitle('watermark_for_ads')->str_value;
        $ad = Ad::create([
            'user_id' => \auth()->id(),
            'category_id' => $category->id,
            'neighborhood_id' => isset($request['neighborhood']) ? $request['neighborhood'] : null,
            'city_id' => $request['city'],
            'title' => $request['title'],
            'description' => isset($request['description']) ? $request['description'] : null,
            'type' => $request['adType'],
            'advertiser' => 'supplier',
            'startDate' => Carbon::now(),
            'mobile' => isset(\auth()->user()->phoneNumberForAds) ? \auth()->user()->phoneNumberForAds : \auth()->user()->mobile,
            'active' => 'inactive',
            'userStatus' => 'active',
            'longitude' => isset($request['longg']) ? $request['longg'] : null,
            'latitude' => isset($request['latt']) ? $request['latt'] : null,
            'address' => isset($request['address']) ? $request['address'] : null,
            'isPaid' => 'unpaid',
            'hasChat' => isset($request['hasChat']) ? 1 : 0,
            'created_user' => \auth()->id(),
            'request_to_agency' => isset($request['request_to_agency']) ? 'pending' : 'noRequest',
            'dedicated_type' => isset($request['request_to_agency']) ? 'agency_to_user' : null,
            'text_watermark_color' => isset($request['color'])?$request['color']:null
        ]);
        $uniqueCode = $ad->id + 100;
        $ad->update(['uniqueCodeOfAd' => $uniqueCode,]);
        if ($ad->type == 'scalar')
            $ad->update(['priority' => 1,]);
        else
            $ad->update(['priority' => 2,]);
        if (\auth()->user()->hasRole('real-state-administrator'))
            $ad->update([
                'agency_id' => auth()->id()
            ]);
        elseif (isset(\auth()->user()->real_estate_admin_id))
            $ad->update([
                'agency_id' => \auth()->user()->real_estate_admin_id
            ]);
        elseif (isset($request['agency_id']) && $request['agency_id']!='undefined')
            $ad->update([
                'agency_id' => $request['agency_id'],
                'request_to_agency' => 'pending',
                'dedicated_type' => 'user_to_agency'
            ]);
        if (isset($request['attribute']))
            $this->attrss($request['attribute'], $ad);
        if (auth()->user()->hasRole('real-state-agent'))
            $text = User::find(auth()->user()->real_estate_admin_id)->slug;
        elseif (auth()->user()->hasRole('real-state-administrator'))
            $text = auth()->user()->slug;
        else
            $text = null;
//        $text=@(new FarsiGD)->persianText($text,'fa', 'normal');
        if (isset($request['adImage'])) {
            foreach ($request['adImage'] as $key => $image) {
                if ($image != null) {

                    if (str_contains($image->getClientMimeType(), 'video')) {
                        $im = $this->uploadFile($image, 'public/upload/adVideos/' . now()->year
                            . '/' . now()->month . '/' . $ad->id);
                        AdVideo::create([
                            'ad_id' => $ad->id,
                            'video' => $im,
                            'created_user' => \auth()->id(),
                        ]);
                    } else {
                        if ($typeOfWatermark == 'ImageAndText') {
                            $im = $this->uploadFileWithImageAndTextWatermark($image, 'public/upload/adImages/' . now()->year
                                . '/' . now()->month . '/' . $ad->id, $watermark, $text, $request['color']??null);
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
                            'created_user' => \auth()->id(),
                        ]);
                    }
                }
            }
        }
        return $ad;
    }

    public function attributesApi($request, $ad, $user)
    {
        foreach (json_decode($request, true) as $key => $attribute) {
            if (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'select') {
                if ($attribute['value'] != null)
                    $ad->attributes()->attach($attribute['id'], [
                        'attribute_item_id' => $attribute['value'],
                        'created_user' => $user->id,
                    ]);
            } elseif (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'int') {
                if ($attribute['value'] != null)
                    $ad->attributes()->attach($attribute['id'], [
                        'value' => $this->convertToEnglish(str_replace(',', '', $attribute['value'])),
                        'created_user' => $user->id,
                    ]);
            } elseif (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'bool') {
                if ($attribute['value'] == 1)
                    $ad->attributes()->attach($attribute['id'], [
                        'value' => 1,
                        'created_user' => $user->id,
                    ]);
            } else {
                if ($attribute['value'] != null)
                    $ad->attributes()->attach($attribute['id'], [
                        'value' => $attribute['value'],
                        'created_user' => $user->id,
                    ]);
            }
        }
    }

    public function storeAdWithAttrsAndImagesApi($request, $user)
    {
        $typeOfWatermark = $this->adminSettingRepository->getAdminSettingByTitle('ads_type_of_watermark')->value;
        $watermark = $this->settingRepository->getSettingByTitle('watermark_for_ads')->str_value;

        $ad = Ad::create([
            'user_id' => $user->id,
            'category_id' => $request->categoryId,
            'neighborhood_id' => isset($request->neighborhood) ? $request->neighborhood : null,
            'city_id' => $request->city,
            'title' => $request->title,
            'description' => isset($request->description) ? $request->description : null,
            'type' => $request->adType,
            'advertiser' => 'supplier',
            'startDate' => Carbon::now(),
            'mobile' => isset($user->phoneNumberForAds) ? $user->phoneNumberForAds : $user->mobile,
            'active' => 'inactive',
            'userStatus' => 'active',
            'longitude' => isset($request->longg) ? $request->longg : null,
            'latitude' => isset($request->latt) ? $request->latt : null,
            'address' => isset($request->address) ? $request->address : null,
            'isPaid' => 'unpaid',
            'hasChat' => isset($request->hasChat) ? 1 : 0,
            'created_user' => $user->id,
            'request_to_agency' => ($request->request_to_agency == 1) ? 'pending' : 'noRequest',
            'dedicated_type' => ($request->request_to_agency == 1) ? 'agency_to_user' : null,
            'text_watermark_color' => $request->color
        ]);
        $uniqueCode = $ad->id + 100;
        $ad->update(['uniqueCodeOfAd' => $uniqueCode,]);
        if ($ad->type == 'scalar')
            $ad->update(['priority' => 1,]);
        else
            $ad->update(['priority' => 2,]);
        if ($user->hasRole('real-state-administrator'))
            $ad->update([
                'agency_id' => $user->id
            ]);
        elseif (isset($user->real_estate_admin_id))
            $ad->update([
                'agency_id' => $user->real_estate_admin_id
            ]);
        elseif (isset($request->agency_id))
            $ad->update([
                'agency_id' => $request->agency_id,
                'request_to_agency' => 'pending',
                'dedicated_type' => 'user_to_agency'
            ]);
        if (isset($request->attribute))
            $this->attributesApi($request->attribute, $ad, $user);
        if ($user->hasRole('real-state-agent'))
            $text = User::find($user->real_estate_admin_id)->slug;
        elseif ($user->hasRole('real-state-administrator'))
            $text = $user->slug;
        else
            $text = null;
        if (isset($request->adImage)) {
            foreach ($request->adImage as $image) {
                if ($image != null) {
//                    $im = $this->uploadFile($image, 'public/upload/adImages/' . now()->year
//                        . '/' . now()->month . '/' . $ad->id);
                    if ($typeOfWatermark == 'ImageAndText') {
                        $im = $this->uploadFileWithImageAndTextWatermark($image, 'public/upload/adImages/' . now()->year
                            . '/' . now()->month . '/' . $ad->id, $watermark, $text, $request->color);
                    } elseif ($typeOfWatermark == 'Image') {
                        $im = $this->uploadFileWithImageWatermark($image, 'public/upload/adImages/' . now()->year
                            . '/' . now()->month . '/' . $ad->id, $watermark);
                    } elseif ($typeOfWatermark == 'Text') {
                        $im = $this->uploadFileWithTextWatermark($image, 'public/upload/adImages/' . now()->year
                            . '/' . now()->month . '/' . $ad->id, $text, $request->color);
                    } else {
                        $im = $this->uploadFile($image, 'public/upload/adImages/' . now()->year
                            . '/' . now()->month . '/' . $ad->id);
                    }
                    AdImage::create([
                        'ad_id' => $ad->id,
                        'image' => $im,
                        'created_user' => $user->id,
                    ]);
                }
            }
        }
            if (isset($request->adVideo)) {
            $im = $this->uploadFile($request->adVideo, 'public/upload/adVideos/' . now()->year
                . '/' . now()->month . '/' . $ad->id);
            AdVideo::create([
                'ad_id' => $ad->id,
                'video' => $im,
                'created_user' => $user->id,
            ]);
        }
        return $ad;
    }
}

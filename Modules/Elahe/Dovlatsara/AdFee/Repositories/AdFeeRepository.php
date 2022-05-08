<?php


namespace Modules\AdFee\Repositories;


use Modules\Ad\Entities\Ad;
use Modules\AdFee\Entities\AdFee;
use Modules\Category\Entities\Category;
use Modules\Setting\Entities\AdminSetting;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;

class AdFeeRepository
{
    public function adminSetting($item)
    {
        return AdminSetting::where('title', $item)->first()->value;
    }
    public function setting($item)
    {
        return Setting::where('title', $item)->first()->str_value;
    }
    public function adFeeFindById($id)
    {
        return AdFee::find($id);
    }

    public function adFindById($id)
    {
        return Ad::find($id);
    }

    public function userFindByToken($token)
    {
        return User::where('api_token', $token)->first();
    }
    public function adFeesFindByCatId($id)
    {
        return AdFee::where('category_id', $id)->get();
    }

    public function categoryFindById($id)
    {
        return Category::find($id);
    }

    public function create($request)
    {
        if (Category::find($request->category)->node==0){
            alert()->error('', 'دسته بندی انتخاب شده غیرمجاز است');
            return redirect()->back();
        }
        return AdFee::create(
            [
                'category_id' => $request->category,
                'expireTimeOfAds' => $request->expireTimeOfAds,
                'generalAdFee' => $request->generalAdFee,
                'scalarAdFee' => $request->scalarAdFee,
                'specialAdFee' => $request->specialAdFee,
                'emergencyAdFee' => $request->emergencyAdFee,
                'created_user' => \auth()->id(),
            ]
        );
    }

    public function update($id, $request)
    {
        return AdFee::where('id', $id)->update(
            [
                'expireTimeOfAds' => $request->expireTimeOfAds,
                'generalAdFee' => $request->generalAdFee,
                'scalarAdFee' => $request->scalarAdFee,
                'specialAdFee' => $request->specialAdFee,
                'emergencyAdFee' => $request->emergencyAdFee,
                'updated_user' => \auth()->id(),
            ]
        );
    }

    public function delete($id)
    {
        AdFee::where('id', $id)->update(['deleted_user'=>auth()->id()]);
        AdFee::where('id', $id)->delete();
    }
}

<?php


namespace Modules\Advertising\Repositories;


use Hekmatinasser\Verta\Verta;
use Modules\Advertising\Entities\Advertising;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\Advertising\Entities\AdvertisingOrder;
use Modules\Category\Entities\Category;
use Modules\Setting\Entities\AdminSetting;
use Modules\User\Entities\User;

class AdvertisingApplicationRepository
{
    public function applications()
    {
        return AdvertisingApplication::with('userInfo', 'advertising')->orderByDesc('created_at')
            ->where('isPaid', 1)->get();
    }

    public function applicationsFindByUserId($id)
    {
        return AdvertisingApplication::where('user_id', $id)->orderByDesc('created_at')->get();
    }

    public function applicationsFindByUserIdWithPaginate($id)
    {
        return AdvertisingApplication::where('user_id', $id)->orderByDesc('created_at')->paginate(10);
    }
    public function advertisingApplicantFindById($id)
    {
        return AdvertisingApplication::find($id);
    }
    public function advertisingsOrders()
    {
        return AdvertisingOrder::all();
    }

    public function delete($id)
    {
        $applicant = $this->advertisingApplicantFindById($id);
        $applicant->update([
            'deleted_user'=>auth()->id(),
        ]);

        $applicant->delete();
    }

    public function userFindByToken($token)
    {
        return User::where('api_token', $token)->first();
    }

    public function advertisingFindById($id)
    {
        return Advertising::find($id);
    }

    public function categoryFindById($id)
    {
        return Category::find($id);
    }
    public function categories()
    {
        $depth = AdminSetting::where('title', 'depthOfCategoryForAdvertising')->first()->value;
        return Category::where('depth', $depth)->get();
    }

    public function advertisingFindByAdvertisementIds($ids)
    {
        return AdvertisingApplication::where('active', 1)->where('isPaid', 1)
            ->whereIn('advertising_id', $ids)
            ->where('startDate', '>=', Verta::now()->startMonth())
            ->where('endDate', '<=', Verta::now()->endMonth())->get();
    }
}

<?php


namespace Modules\Advertising\Repositories;


use Modules\Advertising\Entities\Advertising;
use Modules\Advertising\Entities\AdvertisingOrder;
use Modules\Advertising\Entities\Page;
use Modules\Category\Entities\Category;
use Modules\Setting\Entities\AdminSetting;
use Modules\User\Entities\User;

class AdvertisingRepository
{

    public function pages()
    {
        return Page::all();
    }

    public function pageFindByTitle($title)
    {
        return Page::where('title', $title)->first();
    }

    public function advertisingFindByPage($title)
    {
        $page_id = $this->pageFindByTitle($title)->id;
        $advertising_order_ids = AdvertisingOrder::where('page_id', $page_id)->pluck('id')->toArray();
        return Advertising::whereIn('advertising_order_id', $advertising_order_ids)->pluck('id')->toArray();
    }
    public function advertisingOrders()
    {
        return AdvertisingOrder::all();
    }

    public function advertisingAdmin()
    {
        return Advertising::OrderByDesc('created_at')->get();
    }
    public function advertisings()
    {
        return Advertising::with('advertisingOrder', 'advertisingOrder.page', 'users')->where('active', 1)->get();
    }

    public function advertisingFindById($id)
    {
        return Advertising::find($id);
    }
    public function advertisingsOrders()
    {
        return AdvertisingOrder::with('page')->get();
    }

    public function create($request)
    {
        return Advertising::create([
            'advertising_order_id' => $request->orderPage,
            'title'=>$request->title,
            'price' => $request->price,
            'description'=>$request->description,
            'created_user'=>auth()->id(),
        ]);
    }

    public function edit($request, $id)
    {
        return Advertising::where('id', $id)->update([
            'title'=>$request->title,
            'price' => $request->price,
            'description'=>$request->description,
            'updated_user'=>auth()->id(),
        ]);
    }

    public function delete($id)
    {
        return Advertising::where('id', $id)->update([
            'active'=>0,
            'deleted_user'=>auth()->id(),
        ]);
    }
    public function active($id)
    {
        return Advertising::where('id', $id)->update([
            'active'=>1,
        ]);
    }
    public function userFindByToken($token)
    {
        return User::where('api_token', $token)->first();
    }
    public function categories()
    {
        $depth = AdminSetting::where('title', 'depthOfCategoryForAdvertising')->first()->value;
        return Category::where('depth', $depth)->get();
    }
}

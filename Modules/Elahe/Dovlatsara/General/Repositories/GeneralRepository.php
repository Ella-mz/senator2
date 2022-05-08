<?php


namespace Modules\General\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\Ad\Entities\Ad;
use Modules\Attribute\Entities\Attribute;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Entities\City;
use Modules\GroupAttribute\Entities\GroupAttribute;

class GeneralRepository
{
    public function ads()
    {
        $CategoryRepository = new CategoryRepository();

        return Ad::with('attributes')
            ->where('active', 'active')
            ->where('endDate', '>', Carbon::now())
            ->where('advertiser', 'supplier')
            ->where('userStatus', 'active')
            ->whereIn('category_id', $CategoryRepository->activeCategoryIds())
            ->where('isPaid', 'paid')
            ->orderBy('priority', 'asc')
            ->orderByDesc('startDate');
    }

    public function adsWithCat($cats)
    {
        return Ad::with('attributes')
            ->where('active', 'active')
            ->whereIn('category_id', $cats)
            ->where('endDate', '>', Carbon::now())
            ->where('advertiser', 'supplier')
            ->where('userStatus', 'active')
            ->where('isPaid', 'paid')
            ->orderBy('priority', 'asc')
            ->orderByDesc('startDate');
    }

    public function adsTypeFilter($request)
    {
        return $this->ads()->where('type', $request->type);
    }
    public function cities()
    {
        return City::all();
    }

    public function categoriesDepth1()
    {
        return Category::where('active', 1)->where('depth', 1)->orderBy('order', 'asc')->get();
    }

    public function adsWithIds($ids)
    {
        return Ad::whereIn('id', $ids);
    }

    public function nodeCatsWithIds($ids)
    {
        return Category::whereIn('id', $ids)->where('node', 1);
    }

    public function categoryFindId($id)
    {
        return Category::find($id);
    }

    public function adAttributeWithAdIds($ids)
    {
        return DB::table('ad_attribute')->whereIn('ad_id', $ids)->get();
    }

    public function adAttributeIdsWithAdIds($ids)
    {
        return DB::table('ad_attribute')->whereIn('ad_id', $ids)->pluck('ad_id')->toArray();
    }

    public function attributeFinById($id)
    {
        return Attribute::find($id);
    }

    public function attributeGroupsById($ids)
    {
        return GroupAttribute::whereIn('id', $ids)->orderBy('order', 'asc')->get();
    }
}

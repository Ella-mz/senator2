<?php

namespace Modules\Application\Repositories;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Modules\Application\Entities\Application;
use Modules\Category\Entities\Category;
use Modules\City\Entities\City;
use Modules\GroupAttribute\Entities\GroupAttribute;

class ApplicationRepository
{
    public function applicationOfUser($user)
    {
        return Application::where('user_id', $user->id)
            ->orderByDesc('created_at')->get();
    }
    public function applications()
    {
        return Application::orderByDesc('created_at')->get();
    }

    public function all()
    {
        return Application::orderByDesc('created_at');
    }

    public function applicationsForPanelWithCats($categoryIds)
    {
        return Application::orderByDesc('created_at')->whereIn('category_id', $categoryIds);

    }

    public function applicationAttributeWithapplicationIds($ids): \Illuminate\Support\Collection
    {
        return DB::table('application_attribute')->whereIn('application_id', $ids)->get();
    }

    public function findApplicationById($id)
    {
        return Application::find($id);
    }

    public function findCategoryById($id)
    {
        return Category::find($id);
    }

    public function cities()
    {
        return City::all();
    }
    public function attributeGroupsById($ids)
    {
        return GroupAttribute::whereIn('id', $ids)->orderBy('order', 'asc')->get();
    }

    public function categoriesDepth1()
    {
        return Category::where('depth', 1)->orderBy('order', 'asc')->get();
    }

    public function nodeCatsWithIds($ids)
    {
        return Category::whereIn('id', $ids)->where('node', 1);
    }

    public function postedAdsForSpecificAgency($adminOfAgency)
    {
        return Application::where('agency_id', $adminOfAgency->id)->orderByDesc('created_at');
    }

    public function postedAdsForSpecificAgencyWithCats($categoryIds, $adminOfAgency)
    {
        return Application::where('agency_id', $adminOfAgency->id)->whereIn('category_id', $categoryIds)->orderByDesc('created_at');
    }

    public function applicationsFindByIds($ids)
    {
        return Application::whereIn('id', $ids) ->orderByDesc('created_at')->get();
    }
}

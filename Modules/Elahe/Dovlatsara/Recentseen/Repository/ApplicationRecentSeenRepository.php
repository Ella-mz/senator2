<?php

namespace Modules\Recentseen\Repository;

use Illuminate\Support\Facades\DB;
use Modules\Application\Entities\Application;
use Modules\Category\Entities\Category;
use Modules\City\Entities\City;

class ApplicationRecentSeenRepository
{
    public function cities()
    {
        return City::all();
    }

    public function categoriesDepth1()
    {
        return Category::where('depth', 1)->orderBy('order', 'asc')->get();
    }

    public function getApplicationByApplicationIds($ids)
    {
        return Application::whereIn('id', $ids);
    }

    public function findCategoryById($id)
    {
        return Category::find($id);
    }

    public function nodeCatsWithIds($ids)
    {
        return Category::whereIn('id', $ids)->where('node', 1);
    }

    public function applicationsForPanelByApplicationId($ids)
    {
        return Application::whereIn('id', $ids);
    }

    public function applicationsForPanelWithCats($categoryIds, $ids)
    {
        return Application::whereIn('id', $ids)->whereIn('category_id', $categoryIds)->orderByDesc('created_at');

    }

    public function applicationAttributeWithApplicationIds($ids): \Illuminate\Support\Collection
    {
        return DB::table('application_attribute')->whereIn('application_id', $ids)->get();
    }
}

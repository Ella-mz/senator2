<?php


namespace Modules\Setting\Repository;

use Modules\Setting\Entities\AdminSetting;

class AdminSettingRepository
{
    public function create($requests)
    {
        foreach ($requests as $request){
            AdminSetting::create($request);
        }
    }

    public function delete()
    {
        foreach (AdminSetting::all() as $setting){
            $setting->delete();
        }
    }

    public function getAdminSettingByTitle($title)
    {
        return AdminSetting::where('title', $title)->first();
    }
}

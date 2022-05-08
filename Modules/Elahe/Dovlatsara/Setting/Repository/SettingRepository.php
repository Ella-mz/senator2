<?php


namespace Modules\Setting\Repository;


use Modules\Setting\Entities\Setting;

class SettingRepository
{
    public function create($requests)
    {
        foreach ($requests as $request){
            Setting::create($request);
        }
    }

    public function delete()
    {
        foreach (Setting::all() as $setting){
            $setting->delete();
        }
    }

    public function getSettingByTitle($title)
    {
        return Setting::where('title', $title)->first();
    }

    public function all()
    {
        return Setting::all();
    }

    public function settingFindById($id)
    {
        return Setting::find($id);
    }
}

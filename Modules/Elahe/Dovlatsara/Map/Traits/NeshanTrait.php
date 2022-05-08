<?php namespace Modules\Map\Traits;


use Illuminate\Support\Facades\Http;
use Modules\Setting\Repository\SettingRepository;

trait NeshanTrait
{
    public function neshan_get_address($latitude ,$longitude)
    {
        $response = Http::withHeaders([
            'Api-Key' => $this->neshan_get_api_key(),
        ])->get('https://api.neshan.org/v4/reverse', [
            'lat' => $latitude,
            'lng' => $longitude
        ]);
        return $response->json();
    }

    public function neshan_get_api_key()
    {
        $settingRepository= new SettingRepository() ;
        return $settingRepository->getSettingByTitle('Neshan_API_Key')->str_value;

    }
    public function neshan_get_SDK_key()
    {
        $settingRepository= new SettingRepository ;
        return $settingRepository->getSettingByTitle('Neshan_SDK_Key')->str_value;

    }
}

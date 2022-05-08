<?php

namespace Modules\Map\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\Map\Traits\NeshanTrait;
use Modules\Setting\Repository\AdminSettingRepository;
use Modules\Setting\Repository\SettingRepository;

class NeshanController extends Controller
{
    use NeshanTrait;

    private $settingRepository;
    private $adminSettingRepository;

    public function __construct(SettingRepository $settingRepository, AdminSettingRepository $adminSettingRepository)
    {
        $this->settingRepository = $settingRepository;
        $this->adminSettingRepository = $adminSettingRepository;
    }

    public function get_address($latitude, $longitude)
    {
        $map_service = $this->adminSettingRepository->getAdminSettingByTitle('map_service')->value;

        switch ($map_service) {
            case 'neshan':
                return $this->neshan_get_address($latitude, $longitude);

        }
    }

    public function get_api_key()
    {
        $map_service = $this->adminSettingRepository->getAdminSettingByTitle('map_service');
        switch ($map_service) {
            case 'neshan':
                return $this->neshan_get_api_key();

        }
    }

    public function get_SDK_key()
    {
        $sms_service = $this->adminSettingRepository->getAdminSettingByTitle('map_service');
        switch ($sms_service) {
            case 'neshan':
                return $this->neshan_get_SDK_key();

        }
    }

    public function find_address(Request $request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $response = $this->get_address($latitude, $longitude);

        if ($response['status'] == 'OK') {
            return response()->json([
                'address' => $response['formatted_address'],
                'status' => 200
            ], 200);
        }
        return response()->json([
            'status' => 403
        ], 403);
    }
}

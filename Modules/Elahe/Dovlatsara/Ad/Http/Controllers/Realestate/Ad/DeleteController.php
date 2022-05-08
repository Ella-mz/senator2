<?php

namespace Modules\Ad\Http\Controllers\Realestate\Ad;

use App\Http\Controllers\Controller;
use Modules\Ad\Repositories\AdRepository;
use Modules\Ad\Repositories\AdVideoRepository;
use Modules\AdImageNew\Repositories\AdImageRepository;

class DeleteController extends Controller
{
    private $adRepository;
    private $adVideoRepository;
    private $adImageRepository;

    public function __construct(AdRepository $adRepository, AdVideoRepository $adVideoRepository,
                                AdImageRepository $adImageRepository)
    {
        $this->adRepository = $adRepository;
        $this->adVideoRepository = $adVideoRepository;
        $this->adImageRepository = $adImageRepository;
    }

    /**
     * @param $adId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($adId)
    {
       $this->adRepository->deleteByUser($adId);
        \alert()->success(' ', 'آگهی با موفقیت حذف شد');
        return redirect()->back();
    }

    /**
     * @return false|string
     */
    public function changeAdUserStatus()
    {

        $userStatus = request('userStatus');
        $ad_id = request('ad_id');
        $ad = $this->adRepository->adFindById($ad_id);
        $ad->update(['userStatus'=>$userStatus]);
        return json_encode(true);
    }

    /**
     * @return false|string
     */
    public function deleteAdImage()
    {
        $id = request('id');
        $response = $this->adImageRepository->delete($id, auth()->id());
        return json_encode($response);
    }

    /**
     * @return false|string
     */
    public function deleteAdVideo()
    {
        $id = request('id');
        $response = $this->adVideoRepository->delete($id, auth()->id());
        return json_encode($response);
    }

}

<?php

namespace Modules\Ad\Http\Controllers\User\Ad;

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
    public function delete($adId)
    {
        $this->adRepository->delete($adId, auth()->id());
        \alert()->success('', 'با موفقیت حذف شد');
        return redirect()->back();
    }

    /**
     * @param $adId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function active($adId)
    {
        $this->adRepository->updateUserStatus($adId, 'active');
        \alert()->success('', 'با موفقیت فعال شد');
        return redirect()->back();
    }

    /**
     * @param $adId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function inactive($adId)
    {
        $this->adRepository->updateUserStatus($adId, 'inactive');
        \alert()->success('', 'با موفقیت غیرفعال شد');
        return redirect()->back();
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

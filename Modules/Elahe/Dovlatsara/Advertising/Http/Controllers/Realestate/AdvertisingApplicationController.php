<?php

namespace Modules\Advertising\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Modules\Advertising\Http\Requests\Admin\StoreRequest;
use Modules\Advertising\Http\Requests\Admin\UpdateRequest;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\AdminMasterNew\Http\Traits;

class AdvertisingApplicationController extends Controller
{
    use Traits\UploadFileTrait;

    private $repo;

    public function __construct(AdvertisingApplicationRepository $advertisingApplicationRepository)
    {
        $this->repo = $advertisingApplicationRepository;
    }

    public function index()
    {
        $advertisingApplications = $this->repo->applicationsFindByUserId(auth()->id());
        return view('Advertisings::realestate.applicant.index', compact('advertisingApplications'));
    }

    public function show($applicantId)
    {

        $applicant = $this->repo->advertisingApplicantFindById($applicantId);
        return view('Advertisings::realestate.applicant.show', compact('applicant'));

    }

    public function download($applicant, $type)
    {
        $applicant = $this->repo->advertisingApplicantFindById($applicant);
        if ($type == 'image')
            return response()->download($applicant->image, $applicant->image_title);
        else
            return response()->download($applicant->responsive_image, $applicant->responsive_image_title);
    }

    public function destroy($applicantId)
    {
        $this->repo->delete($applicantId);
        \alert()->success('', 'درخواست با موفقیت حذف شد.');
        return redirect(route('advertisingApplicants.index.admin'));
    }
}

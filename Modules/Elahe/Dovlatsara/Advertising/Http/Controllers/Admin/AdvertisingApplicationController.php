<?php

namespace Modules\Advertising\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\Advertising\Http\Requests\Admin\StoreRequest;
use Modules\Advertising\Http\Requests\Admin\UpdateRequest;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\AdminMasterNew\Http\Traits;
use Modules\CostumerClub\Http\Controllers\Score\ScoreController;

class AdvertisingApplicationController extends Controller
{
    use Traits\UploadFileTrait;

    private $repo;
    private $scoreController;

    public function __construct(AdvertisingApplicationRepository $advertisingApplicationRepository, ScoreController $scoreController)
    {
        $this->repo = $advertisingApplicationRepository;
        $this->scoreController = $scoreController;
    }

    public function index()
    {
        $advertisingApplications = $this->repo->applications();
        return view('Advertisings::admin.applicant.index', compact('advertisingApplications'));
    }

    public function show($applicantId)
    {

        $applicant = $this->repo->advertisingApplicantFindById($applicantId);
        return view('Advertisings::admin.applicant.show', compact('applicant'));

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

    public function activeApplicant(Request $request)
    {
        $advertisingApplication = AdvertisingApplication::where('id', $request->id)->first();
        if ($advertisingApplication) {
            if ($advertisingApplication->check_approve_by_admin == 0 && $request->active == '1') {
                $advertisingApplication->update([
                    'check_approve_by_admin' => 1,
                ]);
                $this->scoreController->create_transaction_score('apply-advertisement', $advertisingApplication->user_id, 'کسب امتیاز به دلیل ثبت تبلیغ');
            }
            $advertisingApplication->update([
                'active' => $request->active,
            ]);
            return json_encode(true);
        } else
            return json_encode(false);
    }
}

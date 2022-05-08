<?php

namespace Modules\ApplicantMembership\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\ApplicantMembership\Entities\ApplicantMembership;
use Modules\ApplicantMembership\Http\Requests\Admin\StoreRequest;
use Modules\ApplicantMembership\Http\Requests\Admin\UpdateRequest;
use Modules\ApplicantMembership\Repositories\ApplicantMembershipRepository;
use Modules\RoleAndPermissionNew\Repositories\RoleRepository;
use RealRashid\SweetAlert\Facades\Alert;

class ApplicantMembershipController extends Controller
{
    private $repo;
    private $roleRepository;

    public function __construct(ApplicantMembershipRepository $applicantMembershipRepository, RoleRepository $roleRepository)
    {
        $this->repo = $applicantMembershipRepository;
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $memberships = $this->repo->getAllActiveApplicantMembership();
        return view('ApplicantMemberships::admin.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $role_array= $this->roleRepository->roles();
        $categories = $this->repo->categoriesDepth1();
        return view('ApplicantMemberships::admin.create', compact('categories', 'role_array'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        foreach ($request->role_type as $role) {
            $membership = ApplicantMembership::create(
                [
//                    'category_id' => $request->category,
                    'title' => $request->title,
                    'duration' => $request->duration,
                    'price' => $request->price,
                    'number_of_applications'=>$request->number_of_applications,
                    'role_type' => $role,
                    'created_user' => \auth()->id(),
                ]
            );
        }

        Alert::success('', 'حق اشتراک با موفقیت ثبت شد');
        return redirect()->route('applicant-memberships.index');
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role_array= $this->roleRepository->roles();
        $membership = $this->repo->applicantMembershipFindById($id);
        return view('ApplicantMemberships::admin.edit', compact('membership', 'role_array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $membership = $this->repo->applicantMembershipFindById($id);

        $membership->update(
            [
                'title' => $request->title,
                'duration' => $request->duration,
                'price' => $request->price,
                'number_of_applications'=>$request->number_of_applications,
                'role_type' => $request->role_type,
                'updated_user' => auth()->id(),
            ]
        );
        Alert::success('', 'حق اشتراک با موفقیت ویرایش شد');
        return redirect()->route('applicant-memberships.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $membership = $this->repo->applicantMembershipFindById($id);
        $membership->update([
            'active'=>0,
            'deleted_user'=>\auth()->id()
        ]);
        Alert::success('', 'حق اشتراک با موفقیت حذف شد');
        return redirect()->back();
    }
}

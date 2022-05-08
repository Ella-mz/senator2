<?php

namespace Modules\Membership\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Membership\Entities\Membership;
use Modules\Membership\Http\Requests\Admin\StoreRequest;
use Modules\Membership\Http\Requests\Admin\UpdateRequest;
use Modules\Membership\Repositories\MembershipRepository;
use Modules\RoleAndPermissionNew\Repositories\RoleRepository;
use RealRashid\SweetAlert\Facades\Alert;

class MembershipController extends Controller
{
    private $repo;
    private $hasSpecial;
    private $hasScalar;
    private $hasEmergency;
    private $roleRepository;

    public function __construct(MembershipRepository $membershipRepository, RoleRepository $roleRepository)
    {
        $this->repo = $membershipRepository;
        $this->hasSpecial = $this->repo->adminSetting('hasSpecial');
        $this->hasScalar = $this->repo->adminSetting('hasScalar');
        $this->hasEmergency = $this->repo->adminSetting('hasEmergency');
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $memberships = $this->repo->getAllActiveMembership();
        return view('Memberships::admin.index', compact('memberships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
//        $hasSpecial = $this->hasSpecial;
//        $hasScalar = $this->hasScalar;
//        $hasEmergency = $this->hasEmergency;
//        $role_array = $this->roleRepository->roles();
        return view('Memberships::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
//        foreach ($request->role_type as $role) {
//            foreach ($request->package_type as $package) {
                $membership = Membership::create(
                    [
                        'title' => $request->title,
                        'duration' => $request->duration,
                        'price' => $request->price,
//                        'package_type' => $package,
//                        'role_type' => $role,
                        'score' => $request->score,
                        'created_user' => \auth()->id(),
                        'description' => $request->description,
                    ]
                );
//            }
//        }

        Alert::success('', 'حق اشتراک با موفقیت ثبت شد');
        return redirect()->route('memberships.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
//        $hasSpecial = $this->hasSpecial;
//        $hasScalar = $this->hasScalar;
//        $hasEmergency = $this->hasEmergency;
        $membership = $this->repo->membershipFindById($id);
//        $role_array = $this->roleRepository->roles();

        return view('Memberships::admin.edit', compact('membership'));
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
        $membership = $this->repo->membershipFindById($id);

        $membership->update(
            [
                'title' => $request->title,
                'duration' => $request->duration,
                'price' => $request->price,
//                'package_type' => $request->package_type,
//                'role_type' => $request->role_type,
                'score' => $request->score,
                'updated_user' => \auth()->id(),
                'description' => $request->description,
            ]
        );
        Alert::success('', 'حق اشتراک با موفقیت ویرایش شد');
        return redirect()->route('memberships.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $membership = $this->repo->membershipFindById($id);
        $membership->update([
            'active' => 0,
            'deleted_user'=>\auth()->id(),
        ]);
        Alert::success('', 'حق اشتراک با موفقیت حذف شد');
        return redirect()->back();
    }

    public function getDescription(Request $request)
    {
        $membership = $this->repo->membershipFindById($request->membershipID);
        $content = '';
        $content = ' <div class="modal-body"><div class="row"><div class="col-md-1 mb-3"></div><div class="col-md-10 mb-3">';
        $content .= '<label class="col-form-label"> توضیحات </label><br>'.$membership->description.'</div> </div>';
        return response()->json([
            'content' => $content,
        ]);
    }
}

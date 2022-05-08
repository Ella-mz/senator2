<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Membership\Entities\Membership;
use Modules\Membership\Http\Requests\Admin\StoreRequest;
use Modules\Membership\Http\Requests\Admin\UpdateRequest;
use Modules\Membership\Repositories\MembershipRepository;
use Modules\Order\Repositories\OrderRepository;
use Modules\Payment\Repositories\PaymentRepository;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Repository\AdminSettingRepository;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    private $paymentRepository;
    private $adminSettingRepository;
    private $orderRepository;

    public function __construct(PaymentRepository $paymentRepository,
                                AdminSettingRepository $adminSettingRepository,
                                OrderRepository $orderRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->orderRepository = $orderRepository;
        $this->adminSettingRepository = $adminSettingRepository;
    }

    /**
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function factor()
    {
        $array = session('dataOfFactor');
        return view('Payments::factor', compact('array'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function create()
    {
        $array = session('dataOfFactor');
        $order = $this->orderRepository->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        foreach ($request->role_type as $role) {
            foreach ($request->package_type as $package) {
                $membership = Membership::create(
                    [
                        'title' => $request->title,
                        'duration' => $request->duration,
                        'price' => $request->price,
                        'package_type' => $package,
                        'role_type' => $role,
                        'number_of_allowed_ads' => $request->number_of_allowed_ads,
                        'created_user' => \auth()->id(),
                    ]
                );
            }
        }

        Alert::success('', 'حق اشتراک با موفقیت ثبت شد');
        return redirect()->route('memberships.index');
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
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
        $hasSpecial = $this->hasSpecial;
        $hasScalar = $this->hasScalar;
        $hasEmergency = $this->hasEmergency;
        $membership = $this->repo->membershipFindById($id);
        $role1 = $this->repo->findRoleBySlug('real-state-administrator');
        $role2 = $this->repo->findRoleBySlug('real-state-agent');
        $role3 = $this->repo->findRoleBySlug('independent-agent');
        $role4 = $this->repo->findRoleBySlug('contractor');
//        $role5 = Role::where('slug', 'ordinary-user')->first();
        $role_array = [];
        array_push($role_array, $role1);
        array_push($role_array, $role2);
        array_push($role_array, $role3);
        array_push($role_array, $role4);
//        array_push($role_array, $role5);
        return view('Memberships::admin.edit', compact('membership', 'role_array', 'hasScalar', 'hasEmergency', 'hasSpecial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $membership = $this->repo->membershipFindById($id);

        $membership->update(
            [
                'title' => $request->title,
                'duration' => $request->duration,
                'price' => $request->price,
                'package_type' => $request->package_type,
                'role_type' => $request->role_type,
                'number_of_allowed_ads' => $request->number_of_allowed_ads,
                'updated_user' => \auth()->id(),
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
    public function destroy($id)
    {
        $membership = $this->repo->membershipFindById($id);
        $membership->update([
            'active' => 0,
            'deleted_user' => \auth()->id(),
        ]);
        Alert::success('', 'حق اشتراک با موفقیت حذف شد');
        return redirect()->back();
    }
}

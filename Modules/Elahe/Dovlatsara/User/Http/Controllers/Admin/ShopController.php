<?php

namespace Modules\User\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\RoleAndPermission\Entities\Role;
use Modules\User\Entities\User;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\AdminMasterNew\Http\Traits;
use Illuminate\Http\JsonResponse;

class ShopController extends Controller
{
    use Traits\UploadFileTrait;

//    public function index()
//    {
//        $role = Role::where('slug', 'real-state-administrator')->first();
//        $user_ids = DB::table('role_user')->where('role_id', $role->id)->pluck('user_id')->toArray();
//        $users = User::with('roles:slug,name')->whereIn('id', $user_ids)->get();
//
//        return view('Users::admin.shop.index', compact('users', 'role'));
//    }
    public function index(Request $request, $active)
    {
        $tags = [];
        $cities = City::all();
        $neighborhoods = Neighborhood::all();
        $role = Role::where('slug', 'real-state-administrator')->first();
//        $user_ids = DB::table('role_user')->where('role_id', $role->id)->pluck('user_id')->toArray();
        $shops = User::with(['roles', 'city', 'neighborhood'])
            ->where('change_to_manager', 1)->where('shop_active', $active)->orderByDesc('created_at')->get();

//        $shops = Shop::orderByDesc('created_at')->get();
        if ($request->t == 1 && isset($request->city) || isset($request->neighborhood)) {
            if (isset($request->city)) {
                $shops = $shops->where('shop_city_id', $request->city);
                $tags['city'] = City::where('id', $request->city)->first()->title;

            }
            if (isset($request->neighborhood)) {
                $shops = $shops->where('shop_neighborhood_id', $request->neighborhood);
                $tags['neighborhood'] = Neighborhood::where('id', $request->neighborhood)->first()->title;
            }
            $shop_ids = $shops->pluck('id')->toArray();
            $shops = User::whereIn('id', $shop_ids)->orderByDesc('created_at')->get();
            return view('Users::admin.shop.index', compact('shops', 'cities', 'neighborhoods', 'tags', 'active'));
        } else {
            $shop_ids = $shops->pluck('id')->toArray();
            $shops = User::whereIn('id', $shop_ids)->orderByDesc('created_at')->get();
            return view('Users::admin.shop.index', compact('shops', 'cities', 'neighborhoods', 'tags', 'active'));
        }
//        return view('Shops::admin.index', compact( 'shops'));
    }

    public function detail(User $user)
    {
        $adminRole = Role::where('slug', 'real-state-administrator')->first();
        $admin_ids = DB::table('role_user')
            ->where('role_id', $adminRole->id)
            ->pluck('user_id')->toArray();
        $realStateAdmins = User::where('id', $user->id)->get();
        $agentRole = Role::where('slug', 'real-state-agent')->first();
        $agent_ids = DB::table('role_user')
            ->where('role_id', $agentRole->id)->pluck('user_id')->toArray();
        $realStateAgents = User::whereIn('id', $agent_ids)->where('real_estate_admin_id', $user->id)->get();
        return view('Users::admin.shop.show', compact('user', 'realStateAgents', 'realStateAdmins'));

    }

    public function deleteFiles(Request $request): JsonResponse
    {
        $user = User::find($request->id);
        if ($request->card == 'nationalCardImage') {
            unlink($user->nationalCardImage);
            $user->update(['nationalCardImage' => null,]);
        } elseif ($request->card == 'shenasnamehImage') {
            unlink($user->shenasnamehImage);
            $user->update(['shenasnamehImage' => null,]);
        } elseif ($request->card == 'mobasherCardImage') {
            unlink($user->mobasherCardImage);
            $user->update(['mobasherCardImage' => null,]);
        } elseif ($request->card == 'unionCardImage') {
            unlink($user->unionCardImage);
            $user->update(['unionCardImage' => null,]);
        } elseif ($request->card == 'userImage') {
            unlink($user->userImage);
            $user->update(['userImage' => null,]);
        }
        return response()->json(['success' => true]);
    }

    public function shopConfirm(User $user)
    {
        if ($user) {
            $user->update([
                'shop_active' => 'active',
                'congrats_check' => 1
            ]);
            $user->roles()->sync(Role::where('slug', 'real-state-administrator')->first()->id);
            Alert::success('', 'کسب و کار تایید شد');
            return redirect()->back();
        } else
            return back();
    }

    public function shopDisConfirm()
    {

        $shop = User::find(request('shopid'));
        if ($shop) {
            $shop->update([
                'shop_active' => 'disConfirm',
                'shop_reasonOfDeactivation' => request('shopreason'),
            ]);
            $shop->roles()->sync(Role::where('slug', 'ordinary-user')
                ->first()->id);

//            if (DB::table('role_user')->where('role_id', 3)->where('user_id', $shop->user->id)->first())
//            {
//                $shop->user->roles()->attach(2);
//                $shop->user->roles()->detach(3);
//            }
            return response()->json([
                'success' => '<div class="text-success"  style="font-size: large">با موفقیت ثبت شد</div>',
            ]);
        } else
            return response()->json([
                'error' => '<div class="text-danger"  style="font-size: large">کسب و کاری موجود نیست.</div>',
            ]);
    }
}

<?php

namespace Modules\Shop\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Shop\Entities\Shop;
use Modules\Union\Entities\Union;
use Modules\User\Entities\User;
use RealRashid\SweetAlert\Facades\Alert;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $tags=[];
        $cities = City::all();
        $neighborhoods = Neighborhood::all();
        $unions = Union::all();
        $shops = Shop::orderByDesc('created_at')->get();
        if ($request->t == 1 && (isset($request->union) || isset($request->city)
                || isset($request->neighborhood))) {
            if (isset($request->union)) {
                $shops = $shops->where('union_id', $request->union);
                $tags['union'] = Union::where('id', $request->union)->first()->title;
            }
            if (isset($request->city)) {
                $shops = $shops->where('city_id', $request->city);
                $tags['city'] = City::where('id', $request->city)->first()->title;

            }
            if (isset($request->neighborhood)) {
                $shops = $shops->where('neighborhood_id', $request->neighborhood);
                $tags['neighborhood'] = Neighborhood::where('id', $request->neighborhood)->first()->title;
            }
//            $shop_ids = $shops->pluck('id')->toArray();
//            $shops=Shop::whereIn('id', $shop_ids)->orderByDesc('created_at')->paginate(10);
            return view('Shops::admin.index', compact('shops', 'cities', 'neighborhoods', 'unions', 'tags'));
        } else {
            $shop_ids = $shops->pluck('id')->toArray();
            $shops=Shop::whereIn('id', $shop_ids)->orderByDesc('created_at')->paginate(10);
            return view('Shops::admin.index', compact('shops', 'cities', 'neighborhoods', 'unions', 'tags'));
        }
//        return view('Shops::admin.index', compact( 'shops'));
    }

    public function confirm(Shop $shop)
    {
        if ($shop) {
            $shop->update([
                'active' => 'confirm'
            ]);
            Alert::success('', 'فروشگاه تایید شد');
            return redirect()->back();
        } else
            return back();
    }

    public function disConfirm()
    {
        $shop = Shop::find(request('shopid'));
        if ($shop) {
            $shop->update([
                'active' => 'disConfirm',
                'reasonOfDeactivation' => request('shopreason'),
            ]);
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
                'error' => '<div class="text-danger"  style="font-size: large">فروشگاه موجود نیست.</div>',
            ]);
    }

    public function destroy(Shop $shop)
    {

    }

    public function detail(Shop $shop)
    {
        $adminRole = Role::where('slug', 'real-state-administrator')->first();
        $admin_ids = DB::table('role_user')->where('role_id', $adminRole->id)->pluck('user_id')->toArray();
        $realStateAdmins = User::whereIn('id', $admin_ids)->where('shop_id', $shop->id)->get();
        $agentRole = Role::where('slug', 'real-state-agent')->first();
        $agent_ids = DB::table('role_user')->where('role_id', $agentRole->id)->pluck('user_id')->toArray();
        $realStateAgents = User::whereIn('id', $agent_ids)->where('shop_id', $shop->id)->get();
        return view('Shops::admin.show', compact('shop', 'realStateAgents', 'realStateAdmins'));

    }
}

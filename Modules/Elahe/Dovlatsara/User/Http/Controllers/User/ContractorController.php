<?php

namespace Modules\User\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\Advertising\Entities\Advertising;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\Advertising\Entities\AdvertisingOrder;
use Modules\Advertising\Entities\Page;
use Modules\Association\Entities\Association;
use Modules\AssociationSkill\Entities\AssociationSkill;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;
use Modules\User\Http\Traits\ContractorCardTrait;
use function Symfony\Component\String\s;

class ContractorController extends Controller
{
    use ContractorCardTrait;

    public function index(Request $request)
    {
        $tags=[];
        $contractor_men_default_photo = Setting::where('title', 'contractor_men_default_photo')->first()->str_value;
        $contractor_women_default_photo = Setting::where('title', 'contractor_women_default_photo')->first()->str_value;

        $user_default_photo = Setting::where('title', 'user_default_photo')->first()->str_value;
        $user_ids = DB::table('role_user')->where('role_id', Role::where('slug', 'contractor')->first()->id)->pluck('user_id')->toArray();
        $contractors = User::where('shop_active', 'active')->whereIn('id', $user_ids);
        $cities = City::all();
//        return response()->json($request->all());

        $associationLevel1 = Association::where('depth', 1)->get();
        if (isset($request->city) || isset($request->neighborhood)
        || isset($request->associationLevel1) || isset($request->associationlevel2)
        || isset($request->skill) || isset($request->search)) {
            $contractors = $contractors->get();
            if (isset($request->search)){
                $tag = $request->search;
                $contractors = $contractors->filter(function ($item) use ($tag) {
                    return strstr($item->name, $tag) ||
                        strstr($item->sirName, $tag) ||
                        strstr($item->user_id, $tag);
                });
            }
            if (isset($request->associationLevel1)) {
                $nodes = Association::findOrFail($request->associationLevel1)->subAssociations->pluck('id')->toArray();
                $association_user = DB::table('association_user')->whereIn('association_id', $nodes)
                    ->pluck('user_id')->toArray();
                $contractors = $contractors->whereIn('id', $association_user);
                array_push($tags, Association::findOrFail($request->associationLevel1)->title);
            }
            if (isset($request->associationlevel2)) {
                $associationlevel2Arr = [];
                foreach ($request->associationlevel2 as $associationlevel2) {
                    array_push($associationlevel2Arr, $associationlevel2);
                    array_push($tags, Association::findOrFail($associationlevel2)->title);
                }
                $association_user = DB::table('association_user')->whereIn('association_id', $associationlevel2Arr)
                    ->pluck('user_id')->toArray();
                $contractors = $contractors->whereIn('id', $association_user);
            }
            if (isset($request->skill)) {
                $skillArr = [];
                foreach ($request->skill as $skill) {
                    array_push($skillArr, $skill);
                    array_push($tags, AssociationSkill::findOrFail($skill)->title);
                }
                $association_skill_user = DB::table('association_skill_user')->whereIn('association_skill_id', $skillArr)
                    ->pluck('user_id')->toArray();

                $contractors = $contractors->whereIn('id', $association_skill_user);
            }
            if (isset($request->city)) {
                $activityRange_user_ids = ActivityRange::where('city_id', $request->city)->pluck('user_id')->toArray();
                $contractors = $contractors->whereIn('id', $activityRange_user_ids);
                array_push($tags, City::find($request->city)->title);
            }
            if (isset($request->neighborhood)) {
                $neighborhoodArr=[];
                foreach (($request->neighborhood) as $neighborhood) {
                    array_push($neighborhoodArr, $neighborhood);
                    array_push($tags, Neighborhood::find($neighborhood)->title);

                }
                $activityRange_user_ids = ActivityRange::whereIn('neighborhood_id', $neighborhoodArr)->pluck('user_id')->toArray();
                $contractors = $contractors->whereIn('id', $activityRange_user_ids);
            }
            $contractor_ids = $contractors->pluck('id')->toArray();
            $contractors =  User::whereIn('id', $contractor_ids)->get();
            $content = $this->contractorCard($contractors);
            $tag = $this->shopTag($tags);

            return response()->json(['content' => $content, 'tags' => $tag]);
        }

        $contractors = $contractors->get();
        $page_id = Page::where('title', 'ContractorsPage')->first()->id;
        $advertising_order_ids = AdvertisingOrder::where('page_id', $page_id)->pluck('id')->toArray();
        $advertisement_ids = Advertising::whereIn('advertising_order_id', $advertising_order_ids)->pluck('id')->toArray();
        $advertisement = AdvertisingApplication::where('active', 1)->where('isPaid', 1)->whereIn('advertising_id', $advertisement_ids)->get();
//        dd($advertisement);
        return view('Users::user.contractor.index', compact('contractors',
            'tags', 'cities', 'user_default_photo', 'associationLevel1', 'contractor_women_default_photo', 'contractor_men_default_photo', 'advertisement'));
    }

    public function show($slug)
    {
//        dd($slug);
        $contractor_men_default_photo = Setting::where('title', 'contractor_men_default_photo')->first()->str_value;
        $contractor_women_default_photo = Setting::where('title', 'contractor_women_default_photo')->first()->str_value;

        $user = User::where('slug', $slug)->first();
        if (!$user){
            alert()->error('', 'پیمانکاری با این مشخصات وجود ندارد');
            return redirect()->back();
        }
        if ($user->hasRole('contractor')) {

            return view('Users::user.contractor.show', compact('user', 'contractor_women_default_photo', 'contractor_men_default_photo'));
        }else
            return redirect()->back();
    }

    public function search(Request $request)
    {
        $tags=[];
        $user_default_photo = Setting::where('title', 'user_default_photo')->first()->str_value;
        $associationLevel1 = Association::where('depth', 1)->get();
        $neighborhoods = Neighborhood::all();
        $tag = $request->search;
        $user_ids = DB::table('role_user')->where('role_id', Role::where('slug', 'contractor')->first()->id)->pluck('user_id')->toArray();

        $contractors = User::where(function ($query) use ($tag, $user_ids) {
            $query->where('shop_active', 'active')->where('name', 'LIKE', '%' . $tag . '%')->whereIn('id', $user_ids);
        })->orWhere(function ($query) use ($tag, $user_ids) {
            $query->where('shop_active', 'active')->where('sirName', 'LIKE', '%' . $tag . '%')->whereIn('id', $user_ids);
        })->paginate(8);
//        $shops = User::where('shop_active', 'active')->where('namee', 'LIKE', '%' . $tag . '%')->paginate(8);
        return view('Users::user.contractor.index', compact('contractors',
            'tags', 'associationLevel1', 'user_default_photo'));
    }

}

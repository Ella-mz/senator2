<?php

namespace Modules\User\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\ActivityRange\Entities\ActivityRange;
use Modules\Advertising\Entities\Advertising;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\Advertising\Entities\AdvertisingOrder;
use Modules\Advertising\Entities\Page;
use Modules\Advertising\Transformers\AdvertisingAppliactionCollection;
use Modules\Advertising\Transformers\AdvertisingApplicationShowCollection;
use Modules\Association\Entities\Association;
use Modules\AssociationSkill\Entities\AssociationSkill;
use Modules\City\Entities\City;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\RoleAndPermission\Entities\Role;
use Modules\Setting\Entities\Setting;
use Modules\User\Entities\User;
use Modules\User\Transformers\ContractorCollection;
use Modules\User\Transformers\ContractorShow;

class ContractorController extends Controller
{

    public function cities($request)
    {
        $cityArr = [];
        $titles = [];
        foreach (json_decode($request['city'], true) as $city) {
            if (City::where('id', $city)->first()) {
                array_push($cityArr, $city);
                array_push($titles, City::find($city)->title);
            }
        }
        return ['cities' => $cityArr, 'titles' => $titles];
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status_code' => 403,
            ], Response::HTTP_FORBIDDEN);
        }
        $tags = [];
        $background_default_photo = Setting::where('title', 'contractors_default_photo_in_app')->first()->str_value;
        $activityRange_user_ids = ActivityRange::where('city_id', json_decode($request->city, true))->pluck('user_id')->toArray();
        foreach (json_decode($request->city, true) as $city) {
            array_push($tags, City::findOrFail($city)->title);
        }

        $user_ids = DB::table('role_user')->where('role_id', Role::where('slug', 'contractor')->first()->id)
            ->pluck('user_id')->toArray();
        $contractors = User::where('shop_active', 'active')->whereIn('id', $user_ids);
        $contractors = $contractors->whereIn('id', $activityRange_user_ids);

        if ((isset($request->associationLevel1) || isset($request->associationLevel2)
        || isset($request->neighborhood) || isset($request->skill) || isset($request->search))) {
            $contractors = $contractors->get();
            if (isset($request->search)){
                $tag = $request->search;
                $contractors = $contractors->filter(function ($item) use ($tag) {
                   return strstr($item->name, $tag) ||
                       strstr($item->sirName, $tag) ||
                       strstr($item->user_id, $tag);
                });
//                $contractors = $contractors->where(function ($query) use ($tag) {
//                    $query->where('shop_active', 'active')->where('name', 'LIKE', '%' . $tag . '%');
//                })->orWhere(function ($query) use ($tag) {
//                    $query->where('shop_active', 'active')->where('sirName', 'LIKE', '%' . $tag . '%');
//                });
            }
            if (isset($request->associationLevel1)) {
                $nodes = Association::findOrFail($request->associationLevel1)->subAssociations->pluck('id')->toArray();
                $association_user = DB::table('association_user')->whereIn('association_id', $nodes)
                    ->pluck('user_id')->toArray();
                $contractors = $contractors->whereIn('id', $association_user);
                array_push($tags, Association::findOrFail($request->associationLevel1)->title);
            }
            if (isset($request->associationLevel2)) {
                $associationlevel2Arr = [];
                foreach (json_decode($request->associationLevel2, true) as $associationlevel2) {
                    array_push($associationlevel2Arr, $associationlevel2);
                    array_push($tags, Association::findOrFail($associationlevel2)->title);
                }
                $association_user = DB::table('association_user')->whereIn('association_id', $associationlevel2Arr)
                    ->pluck('user_id')->toArray();

                $contractors = $contractors->whereIn('id', $association_user);
            }
            if (isset($request->skill)) {
                $skillArr = [];
                foreach (json_decode($request->skill, true) as $skill) {
                    array_push($skillArr, $skill);
                    array_push($tags, AssociationSkill::findOrFail($skill)->title);
                }
                $association_skill_user = DB::table('association_skill_user')->whereIn('association_skill_id', $skillArr)
                    ->pluck('user_id')->toArray();

                $contractors = $contractors->whereIn('id', $association_skill_user);
            }
            if (isset($request->neighborhood)) {
                $neighborhoodArr = [];
                foreach (json_decode($request->neighborhood, true) as $neighborhood) {
                    array_push($neighborhoodArr, $neighborhood);
                    array_push($tags, Neighborhood::find($neighborhood)->title);

                }
                $activityRange_user_ids = ActivityRange::whereIn('neighborhood_id', $neighborhoodArr)->pluck('user_id')->toArray();
                $contractors = $contractors->whereIn('id', $activityRange_user_ids);

            }
            $contractor_ids = $contractors->pluck('id')->toArray();
            $contractors = User::whereIn('id', $contractor_ids)->paginate(10);

            return response()->json([
                'status_code' => 200,
                'data' => [
                    'data' => new ContractorCollection($contractors),
                    'tags'=>$tags,
                    'backgroundPhoto' => isset($background_default_photo) ? url($background_default_photo) : '',
                    'total' => $contractors->total(),
                    'path' => $contractors->path(),
                    'perPage' => $contractors->perPage(),
                    'currentPage' => $contractors->currentPage(),
                    'lastPage' => $contractors->lastPage(),
                    ],
            ], Response::HTTP_OK);
        }

        $contractors = $contractors->paginate(10);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => new ContractorCollection($contractors),
                'tags'=>$tags,
                'backgroundPhoto' => isset($background_default_photo) ? url($background_default_photo) : '',
                'total' => $contractors->total(),
                'path' => $contractors->path(),
                'perPage' => $contractors->perPage(),
                'currentPage' => $contractors->currentPage(),
                'lastPage' => $contractors->lastPage(),
            ],
        ], Response::HTTP_OK);
    }

    public function show($slug)
    {
        try {
            $background_default_photo = Setting::where('title', 'contractors_default_photo_in_app')->first()->str_value;
            $user = User::where('slug', $slug)->first();
            if (!$user)
                return response()->json([
                    'status_code' => 404,
                    'errors' => ['slug is invalid'],
                ], Response::HTTP_NOT_FOUND);

            if (!$user->hasRole('contractor'))
                return response()->json([
                    'status_code' => 403,
                    'errors' => ['this user is not a contractor'],
                ], Response::HTTP_FORBIDDEN);

            return response()->json([
                'status_code' => 200,
                'data' => new ContractorShow($user),
                'backgroundPhoto' => isset($background_default_photo) ? url($background_default_photo) : '',

            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 403,
                'errors' => [],
            ], Response::HTTP_FORBIDDEN);
        }

    }

    public function search(Request $request)
    {
        $user_ids = DB::table('role_user')->where('role_id', Role::where('slug', 'contractor')->first()->id)->pluck('user_id')->toArray();

        $tag = $request->search;
        $contractors = User::where(function ($query) use ($tag, $user_ids) {
            $query->where('shop_active', 'active')->where('name', 'LIKE', '%' . $tag . '%')->whereIn('id', $user_ids);
        })->orWhere(function ($query) use ($tag, $user_ids) {
            $query->where('shop_active', 'active')->where('sirName', 'LIKE', '%' . $tag . '%')->whereIn('id', $user_ids);
        })->paginate(8);
        $background_default_photo = Setting::where('title', 'contractors_default_photo_in_app')->first()->str_value;
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => new ContractorCollection($contractors),
                'backgroundPhoto' => isset($background_default_photo) ? url($background_default_photo) : '',
                'total' => $contractors->total(),
                'path' => $contractors->path(),
                'perPage' => $contractors->perPage(),
                'currentPage' => $contractors->currentPage(),
                'lastPage' => $contractors->lastPage(),
            ],

        ]);
//        $shops = User::where('shop_active', 'active')->where('namee', 'LIKE', '%' . $tag . '%')->paginate(8);
//        return view('Users::user.contractor.index', compact('contractors',
//            'tags', 'associationLevel1'));
    }

}

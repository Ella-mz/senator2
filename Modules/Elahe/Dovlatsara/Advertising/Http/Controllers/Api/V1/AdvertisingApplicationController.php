<?php

namespace Modules\Advertising\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Advertising\Entities\Advertising;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\Advertising\Entities\AdvertisingOrder;
use Modules\Advertising\Entities\Page;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\AdminMasterNew\Http\Traits;
use Modules\Advertising\Transformers\AdvertisingAppliactionCollection;
use Modules\Advertising\Transformers\AdvertisingApplicationShowCollection;
use Modules\Category\Entities\Category;
use Modules\Category\Transformers\CategoryCollection;
use Modules\Setting\Entities\Setting;

class AdvertisingApplicationController extends Controller
{
    use Traits\UploadFileTrait;

    private $repo;

    public function __construct(AdvertisingApplicationRepository $advertisingApplicationRepository)
    {
        $this->repo = $advertisingApplicationRepository;
    }

    public function endDateArray($advertisingId)
    {
        $array = [];
        foreach (AdvertisingApplication::where('advertising_id', $advertisingId)->where('isPaid', 1)->get() as $key => $application) {
            $array[$key + 1] = substr(Verta::parse($application->endDate)->formatDate(), 0, 7) . '-' . $advertisingId . '-' . $application->category;
        }
        return $array;
    }

    public function apply(Request $request)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $headerValidator->errors()->all(),
                'status_code' => 401
            ], 401);
        }
        $validator = Validator::make($request->all(), [
            'advertisingId' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status' => 403
            ], Response::HTTP_FORBIDDEN);
        }
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        $array = $this->endDateArray($request->advertisingId);
        $advertising = $this->repo->advertisingFindById($request->advertisingId);
        $numberOfMonths = Setting::where('title', 'number_of_months')->first()->str_value;

        $flag = 0;
        $dates = [];
        $counter = 0;
        if ($advertising->advertisingOrder->page->hasCategory) {
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'date' => [],
                    'category' => new CategoryCollection($this->repo->categories())
                ],
            ], Response::HTTP_OK);
//            $validator = Validator::make($request->all(), [
//                'categoryId' => 'required',
//            ]);
//            if ($validator->fails()) {
//                return response()->json([
//                    'data' => [],
//                    'errors' => $validator->errors()->all(),
//                    'status' => 403
//                ], Response::HTTP_FORBIDDEN);
//            }
//            $advertising = Advertising::find(\request('advertisingId'));
//            $catId = \request('categoryId');
//            $array = $this->endDateArray($advertising->id);
//            for ($i = 1; $i <= $numberOfMonths + $flag; $i++) {
//
//                if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertising->id . '-' . $catId, $array) == false) {
//                    $dates[$counter]['key'] = $i;
//                    $dates[$counter]['value'] = Verta::now()->addMonths($i)->format('%B %Y');
//                    $counter = $counter + 1;
//                } else {
//                    $i = $i + 1;
//                    $flag = $flag + 1;
//                    if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertising->id . '-' . $catId, $array) == false) {
//
//                        $dates[$counter]['key'] = $i;
//                        $dates[$counter]['value'] = Verta::now()->addMonths($i)->format('%B %Y');
//                        $counter = $counter + 1;
//                    } else
//                        $flag = $flag + 1;
//                }
//            }
        } else {
            for ($i = 0; $i <= $numberOfMonths + $flag; $i++) {
                if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $request->advertisingId . '-', $array) == false) {
                    $dates[$counter]['key'] = $i;
                    $dates[$counter]['value'] = Verta::now()->addMonths($i)->format('%B %Y');
                    $counter = $counter + 1;
                } else {
                    $i = $i + 1;
                    $flag = $flag + 1;
                    if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $request->advertisingId . '-', $array) == false) {
                        $dates[$counter]['key'] = $i;
                        $dates[$counter]['value'] = Verta::now()->addMonths($i)->format('%B %Y');
                        $counter = $counter + 1;
                    } else {
                        $flag = $flag + 1;
                    }
                }
            }
            return response()->json([
                'status_code' => 200,
                'data' => [
                    'date' => $dates,
                    'category' => []
                ],
            ], Response::HTTP_OK);
        }
    }

    public function getDateWithCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'advertisingId' => 'required',
            'categoryId' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status' => 403
            ], Response::HTTP_FORBIDDEN);
        }
        $flag = 0;
        $dates = [];
        $counter = 0;
        $numberOfMonths = Setting::where('title', 'number_of_months')->first()->str_value;
        $advertising = $this->repo->advertisingFindById($request->advertisingId);
        $category = $this->repo->categoryFindById($request->categoryId);
        $array = $this->endDateArray($advertising->id);
        for ($i = 0; $i <= $numberOfMonths + $flag; $i++) {

            if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertising->id . '-' . $category->id, $array) == false) {
                $dates[$counter]['key'] = $i;
                $dates[$counter]['value'] = Verta::now()->addMonths($i)->format('%B %Y');
                $counter = $counter + 1;
            } else {
                $i = $i + 1;
                $flag = $flag + 1;
                if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertising->id . '-' . $category->id, $array) == false) {

                    $dates[$counter]['key'] = $i;
                    $dates[$counter]['value'] = Verta::now()->addMonths($i)->format('%B %Y');
                    $counter = $counter + 1;
                } else
                    $flag = $flag + 1;
            }
        }
        return response()->json([
            'status_code' => 200,
            'data' => [
                'date' => $dates,
                'category' => []
            ],
        ], Response::HTTP_OK);
    }

    public function applySubmit(Request $request)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => '',
                'errors' => $headerValidator->errors()->all(),
                'status_code' => 401
            ], 401);
        }
        $validator = Validator::make($request->all(), [
            'advertisingId' => 'required',
            'image' => 'required',
//            'responsiveImage' => 'required',
            'categoryId' => [
                Rule::requiredIf(isset($request->advertisingId) && $this->repo->advertisingFindById($request->advertisingId)->advertisingOrder->page->hasCategory == 1),
            ],
            'date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => '',
                'errors' => $validator->errors()->all(),
                'status' => 403
            ], Response::HTTP_FORBIDDEN);
        }
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);

        if ($request->file('responsiveImage')) {
            $responsiveImage = $this->uploadFile($request->file('responsiveImage'), 'public/upload/advertisement/responsiveImage/' . now()->year
                . '/' . now()->month);
        } else
            $responsiveImage = null;
        if ($request->file('image')) {
            $image = $this->uploadFile($request->file('image'), 'public/upload/advertisement/image/' . now()->year
                . '/' . now()->month);
        } else
            $image = null;
        AdvertisingApplication::create([
            'user_id' => $user->id,
            'advertising_id' => $request->advertisingId,
            'link' => $request->link,
            'startDate' => Verta::now()->addMonths($request->date)->startMonth(),
            'endDate' => Verta::now()->addMonths($request->date)->endMonth(),
            'image' => $image,
            'image_title' => $request->file('image')->getClientOriginalName(),
            'responsive_image' => $responsiveImage,
            'responsive_image_title' => $request->file('responsiveImage')->getClientOriginalName(),
            'category' => $request->categoryId,
        ]);
        return response()->json([
            'status_code' => 200,
            'data' => 'تبلیغ با موفقیت خریداری شد',
        ], Response::HTTP_OK);
    }

    public function index(Request $request)
    {
        $headerValidator = Validator::make($request->header(), [
            'authorization' => 'required',
        ]);
        if ($headerValidator->fails()) {
            return response()->json([
                'data' => '',
                'errors' => $headerValidator->errors()->all(),
                'status_code' => 401
            ], 401);
        }
        $user = $this->repo->userFindByToken($request->header('authorization'));
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        $advertisingApplications = $this->repo->applicationsFindByUserIdWithPaginate($user->id);
        return response()->json([
            'status_code' => 200,
            'data' => [
                'data' => new AdvertisingAppliactionCollection($advertisingApplications),
                'total' => $advertisingApplications->total(),
//                'next_page_url' => $contractors->next_page_url(),
                'path' => $advertisingApplications->path(),
                'perPage' => $advertisingApplications->perPage(),
                'currentPage' => $advertisingApplications->currentPage(),
                'lastPage' => $advertisingApplications->lastPage(),
            ],
            'errors' => []
        ], Response::HTTP_OK);
//        return view('Advertisings::realestate.applicant.index', compact('advertisingApplications'));
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'advertisingType' => 'required',
//            'image' => 'required',
            'categoryId' => [
                Rule::requiredIf(isset($request->advertisingType)
                    && $request->advertisingType == 'filterPage'),
            ],
//            'date'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status' => 403
            ], Response::HTTP_FORBIDDEN);
        }
        if ($request->advertisingType == 'contractors') {

            $page_id = Page::where('title', 'ContractorsPage')->first()->id;
            $advertising_order_ids = AdvertisingOrder::where('page_id', $page_id)->pluck('id')->toArray();
            $advertisement_ids = Advertising::whereIn('advertising_order_id', $advertising_order_ids)->pluck('id')->toArray();
            $advertisement = AdvertisingApplication::where('active', 1)->whereIn('advertising_id', $advertisement_ids)->get();

        } elseif ($request->advertisingType == 'real-estates') {
            $page_id = Page::where('title', 'RealestatePage')->first()->id;
            $advertising_order_ids = AdvertisingOrder::where('page_id', $page_id)->pluck('id')->toArray();
            $advertisement_ids = Advertising::whereIn('advertising_order_id', $advertising_order_ids)->pluck('id')->toArray();
            $advertisement = AdvertisingApplication::where('active', 1)->whereIn('advertising_id', $advertisement_ids)->get();

        } elseif ($request->advertisingType == 'homePage') {
            $page_id = Page::where('title', 'homePage')->first()->id;
            $advertising_order_id = AdvertisingOrder::where('page_id', $page_id)->where('location', 'top1')->first()->id;
            $advertisement_ids = Advertising::where('advertising_order_id', $advertising_order_id)->pluck('id')->toArray();
            $advertisement = AdvertisingApplication::where('active', 1)->whereIn('advertising_id', $advertisement_ids)->get();

        } elseif ($request->advertisingType == 'filterPage') {
            $page_id = Page::where('title', 'FilterPage')->first()->id;
            $advertising_order_ids = AdvertisingOrder::where('page_id', $page_id)->pluck('id')->toArray();
            $advertisement_ids = Advertising::whereIn('advertising_order_id', $advertising_order_ids)->pluck('id')->toArray();
            $advertisement = AdvertisingApplication::where('active', 1)->whereIn('advertising_id', $advertisement_ids)->get();
        }
        $ad_ids = [];
        foreach ($advertisement as $ad) {
            if (($request->advertisingType == 'filterPage' ? $ad->checkCategory(Category::find($request->categoryId)) : true)
                && $ad->startDate <= Verta::now()->startMonth()
                && $ad->endDate <= Verta::now()->endMonth()
                && $ad->endDate > Verta::now()->startMonth()) {
                array_push($ad_ids, $ad->id);
            }
        }
        $advertisement = AdvertisingApplication::whereIn('id', $ad_ids)->get();

        return response()->json([
            'status_code' => 200,
            'data' => new AdvertisingApplicationShowCollection($advertisement)
        ], Response::HTTP_OK);

    }
}

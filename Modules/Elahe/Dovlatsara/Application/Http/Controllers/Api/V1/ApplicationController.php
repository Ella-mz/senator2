<?php

namespace Modules\Application\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Modules\Advertising\Repositories\AdvertisingApplicationRepository;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\Advertising\Transformers\AdvertisingApplicationShowCollection;
use Modules\Application\Entities\Application;
use Modules\Application\Entities\ApplicationNeighborhood;
use Modules\Application\Http\Traits\StoreApplicationTrait;
use Modules\Application\Repositories\ApplicationRepository;
use Modules\Application\Transformers\ApplicationCollection;
use Modules\Attribute\Entities\Attribute;
use Modules\Category\Entities\Category;
use Modules\GroupAttribute\Entities\GroupAttribute;
use Modules\GroupAttribute\Transformers\GroupAttributeForCreateCollection;
use Modules\User\Entities\User;

class ApplicationController extends Controller
{
    use StoreApplicationTrait;

    private $repo;
    private $advertisingRepository;
    private $advertisingApplicationRepository;

    public function __construct(ApplicationRepository $applicationRepository, AdvertisingRepository $advertisingRepository,
                                AdvertisingApplicationRepository $advertisingApplicationRepository)
    {
        $this->repo = $applicationRepository;
        $this->advertisingRepository = $advertisingRepository;
        $this->advertisingApplicationRepository = $advertisingApplicationRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
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
        $user = User::where('api_token', $request->header('authorization'))->first();
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        $applications = Application::where('user_id', $user->id)
            ->orderByDesc('created_at')->paginate(10);
        return response()->json([
            'status_code' => 200,
            'data'=>[
                'data' => new ApplicationCollection($applications),
                'total' => $applications->total(),
                'path' => $applications->path(),
                'perPage' => $applications->perPage(),
                'currentPage' => $applications->currentPage(),
                'lastPage' => $applications->lastPage(),
            ] ,
        ], Response::HTTP_OK);
//        $applications = $this->repo->applications();
//        return view('Applications::user.index', compact('applications'));
    }

    public function show(Request $request)
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
        $user = User::where('api_token', $request->header('authorization'))->first();
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);
        $validator = Validator::make($request->all(), [
            'applicationId' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status_code' => 403
            ], Response::HTTP_FORBIDDEN);
        }
        $application = $this->repo->findApplicationById($request->applicationId);
        if (!$application)
            return response()->json([
                'status_code' => 404,
                'errors' => ['آیدی درخواست نامعتبر است'],
            ], Response::HTTP_NOT_FOUND);
        if ($user->id != $application->user_id)
            return response()->json([
                'status_code' => 403,
                'errors' => ['دسترسی به این درخواست برای کاربر غیر مجاز است'],
            ], Response::HTTP_FORBIDDEN);
        return response()->json([
            'status_code' => 200,
            'data'=> new \Modules\Application\Transformers\Application($application),
        ], Response::HTTP_OK);

    }

    public function getAttributeGroups($category_id, $advertiser)
    {
        $category = Category::find($category_id);
        $paths = explode(',', $category->path);
        $nodes = [];
        foreach ($category->groupAttributes()->where('advertiser', $advertiser)->get() as $attrGroup) {
            if ($attrGroup->attributes->count() > 0)
                $nodes[$attrGroup->id] = $attrGroup->id;
        }
        if ($category->path != null) {
            for ($i = 0; $i < count($paths); $i++) {
                if (Category::where('id', $paths[$i])->first()->groupAttributes()->where('advertiser', $advertiser)->count() >= 1) {
                    foreach (Category::where('id', $paths[$i])->first()->groupAttributes()->where('advertiser', $advertiser)->get() as $attrGroup) {
                        if ($attrGroup->attributes->count() > 0)
                            $nodes[$attrGroup->id] = $attrGroup->id;
                    }
                }
            }
        }
        $attrGroups = GroupAttribute::whereIn('id', $nodes)->get();
        return $attrGroups;
    }

    public function create(Request $request)
    {
//        $headerValidator = Validator::make($request->header(), [
//            'authorization' => 'required',
//        ]);
//        if ($headerValidator->fails()) {
//            return response()->json([
//                'data' => [],
//                'errors' => $headerValidator->errors()->all(),
//                'status' => 401
//            ], 401);
//        }
        $advertisement_ids = $this->advertisingRepository->advertisingFindByPage('ApplicationFormRequest');
        $advertisement = $this->advertisingApplicationRepository->advertisingFindByAdvertisementIds($advertisement_ids);
//        $user = User::where('api_token', $request->header('authorization'))->first();
//        if (!$user)
//            return response()->json([
//                'status_code' => 404,
//                'errors' => ['token is invalid'],
//            ], Response::HTTP_NOT_FOUND);
        $validator = Validator::make($request->all(), [
            'categoryId' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status_code' => 403
            ], Response::HTTP_FORBIDDEN);
        }
        $category = $this->repo->findCategoryById($request->categoryId);
        $attributeGroups = $this->getAttributeGroups($category->id, 'applicant');
        $attributeGroups = $attributeGroups->whereIn('advertiser', ['applicant', 'both'])
            ->pluck('id')->toArray();

        $attributeGroups = $this->repo->attributeGroupsById($attributeGroups);
        return response()->json([
            'status_code' => 200,
            'data' => new GroupAttributeForCreateCollection($attributeGroups),
            'advertisement' => new AdvertisingApplicationShowCollection($advertisement)
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
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
        $user = User::where('api_token', $request->header('authorization'))->first();
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'city'=>'required',
//            'phone'=>'required',
            'categoryId'=>'required'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all(),
                'status_code' => 403
            ], 403);
//            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = $this->repo->findCategoryById($request->categoryId);
        if (!$category)
            return response()->json([
                'status_code' => 404,
                'errors' => ['دسته بندی نامعتبر است'],
            ], Response::HTTP_NOT_FOUND);


        if ($request->attribute != null) {
            foreach (json_decode($request->attribute, true) as $key => $attribute) {
                if ((Attribute::where('id', $attribute['id'])->first()->attribute_type=='int'
                    || Attribute::where('id', $attribute['id'])->first()->attribute_type=='select')
                    && Attribute::where('id', $attribute['id'])->first()->hasScale) {
                    if (Attribute::where('id', $attribute['id'])->first()->isFilterField == 1
                        && (($attribute['min'] == null) || ($attribute['max'] == null))
                        && (Attribute::where('id', $attribute['id'])->first()->attribute_type != 'bool')) {
                        return response()->json([
                            'data' => '',
                            'errors' => 'مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' الزامی است.',
                            'status_code' => 403
                        ], 403);
                    }
                } else {
                    if (Attribute::where('id', $attribute['id'])->first()->isFilterField == 1
                        && ($attribute['min'] == null) && (Attribute::where('id', $attribute['id'])->first()->attribute_type != 'bool')) {
                        return response()->json([
                            'data' => '',
                            'errors' => 'مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' الزامی است.',
                            'status_code' => 403
                        ], 403);
                    }
                }
            }
            foreach (json_decode($request->attribute, true) as $key => $attribute) {
                if (Attribute::where('id', $attribute['id'])->first()->isFilterField == 1) {
                    if ((Attribute::where('id', $attribute['id'])->first()->attribute_type=='int'
                        || Attribute::where('id', $attribute['id'])->first()->attribute_type=='select')
                        && Attribute::where('id', $attribute['id'])->first()->hasScale) {
                        if (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'int'
                            && !(is_numeric($this->convertToEnglish(str_replace(',', '', $attribute['min'])))
                            && is_numeric($this->convertToEnglish(str_replace(',', '', $attribute['max']))))) {
                            return response()->json([
                                'data' => '',
                                'errors' => ['مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' باید به صورت عدد وارد شود است.'],
                                'status_code' => 403
                            ], 403);
                        }
                    } else {
                        if (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'int'
                            && (!is_numeric(str_replace(',', '', $attribute['min'])))) {
                            return response()->json([
                                'data' => '',
                                'errors' => ['مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' باید به صورت عدد وارد شود است.'],
                                'status_code' => 403
                            ], 403);
                        }
                    }
                } else {
                    if ((Attribute::where('id', $attribute['id'])->first()->attribute_type=='int'
                        || Attribute::where('id', $attribute['id'])->first()->attribute_type=='select')
                        && Attribute::where('id', $attribute['id'])->first()->hasScale) {
                        if ($attribute['min'] != null && $attribute['max'] != null){
                            if (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'int'
                                && !(is_numeric($this->convertToEnglish(str_replace(',', '', $attribute['min'])))
                                    && is_numeric($this->convertToEnglish(str_replace(',', '', $attribute['max']))))) {
                                return response()->json([
                                    'data' => '',
                                    'errors' => ['مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' باید به صورت عدد وارد شود است.'],
                                    'status_code' => 403
                                ], 403);
                            }
                        }
                    } else {
                        if ($attribute['min'] != null) {
                            if (Attribute::where('id', $attribute['id'])->first()->attribute_type == 'int'
                                && (!is_numeric(str_replace(',', '', $attribute['min'])))) {
                                return response()->json([
                                    'data' => '',
                                    'errors' => ['مشخصه  ' . Attribute::where('id', $attribute['id'])->first()->title . ' باید به صورت عدد وارد شود است.'],
                                    'status_code' => 403
                                ], 403);
                            }
                        }
                    }
                }
            }
        }
        $applicant = $this->storeApplicationWithAttrsApi($request, $user);
        if (isset($request->neighborhood)) {
            foreach (json_decode($request->neighborhood, true) as $neighborhood) {
                ApplicationNeighborhood::create([
                    'application_id' => $applicant->id,
                    'neighborhood_id' => $neighborhood,
                    'created_user' => $user->id
                ]);
            }
        }
        return response()->json([
            'status_code' => 200,
            'data' => 'با موفقیت ثبت شد',
        ], Response::HTTP_OK);
    }


    public function destroy(Request $request, $applicationId)
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
        $user = User::where('api_token', $request->header('authorization'))->first();
        if (!$user)
            return response()->json([
                'status_code' => 404,
                'errors' => ['token is invalid'],
            ], Response::HTTP_NOT_FOUND);

        $application = $this->repo->findApplicationById($applicationId);
        if ($user->id != $application->user_id)
            return response()->json([
                'status_code' => 403,
                'errors' => ['دسترسی به این درخواست برای کاربر غیر مجاز است'],
            ], Response::HTTP_FORBIDDEN);
        $application->update(['deleted_user'=>$user->id]);
        $application->delete();
        return response()->json([
            'status_code' => 200,
            'data' => 'با موفقیت حذف شد',
        ], Response::HTTP_OK);
    }
}

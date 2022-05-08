<?php

namespace Modules\Application\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\Application\Entities\Application;
use Modules\Application\Entities\ApplicationNeighborhood;
use Modules\Application\Http\Traits\StoreApplicationTrait;
use Modules\Application\Repositories\ApplicationRepository;
use Modules\Attribute\Entities\Attribute;
use Modules\Category\Entities\Category;
use Modules\Category\Repositories\CategoryRepository;
use Modules\City\Entities\City;
use Modules\City\Repositories\CityRepository;
use Modules\CommonQuestion\Entities\CommonQuestion;
use Modules\GroupAttribute\Entities\GroupAttribute;
use Modules\Neighborhood\Entities\Neighborhood;
use Modules\Setting\Entities\Setting;
use RealRashid\SweetAlert\Facades\Alert;

class ApplicationController extends Controller
{
    use StoreApplicationTrait;

    private $repo;
    private $categoryRepository;
    private $cityRepository;

    public function __construct(ApplicationRepository $applicationRepository, CategoryRepository $categoryRepository,
                                CityRepository $cityRepository)
    {
        $this->repo = $applicationRepository;
        $this->categoryRepository = $categoryRepository;
        $this->cityRepository = $cityRepository;
    }

    public function index(Request  $request)
    {
        $tags = [];
        $applications = $this->repo->applications();
        $categories = $this->categoryRepository->nodeCategories();
        $cities = $this->cityRepository->all();
        if ($request->t == 1 && ((isset($request->category) || isset($request->neighborhood) || isset($request->city)
                || (isset($request->active))))) {
            if (isset($request->category)) {
                $applications = $applications->where('category_id', $request->category);
                $tags['category'] = $this->categoryRepository->categoryFindById($request->category)->createStringAsParents();
            }
            if (isset($request->city)) {
                $applications = $applications->where('city_id', $request->city);
                $tags['city'] = $this->cityRepository->cityFindById($request->city)->title;
            }
            if (isset($request->neighborhood)) {
                $applicationIds = ApplicationNeighborhood::whereIn('application_id', $applications->pluck('id')->toArray())
                    ->where('neighborhood_id', $request->neighborhood)->pluck('application_id')->toArray();
                $applications = $this->repo->applicationsFindByIds($applicationIds);
                $tags['neighborhood'] = Neighborhood::find($request->neighborhood)->title;
            }
            if (isset($request->active)) {
                $applications = $applications->where('active', $request->active);
                if ($request->active == 'active')
                    $tags['active'] = 'فعال';
                elseif ($request->active == 'unpaid')
                    $tags['active'] = 'غیرفعال';
                elseif ($request->active == 'disConfirm')
                    $tags['active'] = 'عدم تایید';
            }
            $applications_ids = $applications->pluck('id')->toArray();
            $applications = $this->repo->applicationsFindByIds($applications_ids);

            return view('Applications::admin.index', compact('applications', 'categories', 'cities', 'tags'));
        }

        return view('Applications::admin.index', compact('applications', 'categories', 'cities', 'tags'));
    }

    public function show($applicationId)
    {
        $application = $this->repo->findApplicationById($applicationId);
        return view('Applications::admin.show', compact('application'));

    }

//    public function activeApplication(Request $request)
//    {
//        $application = $this->repo->findApplicationById($request->id);
//
//        if ($application) {
//            $application->update([
//                'active' => $request->active,
//            ]);
//            return json_encode(true);
//        } else
//            return json_encode(false);
//    }


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

    public function create($categoryId)
    {
        $category = $this->repo->findCategoryById($categoryId);
        $cities = $this->repo->cities();
        $attributeGroups = $this->getAttributeGroups($category->id, 'applicant');
//        $grandCategory_id = $category->getGrandParent();
        $content = '';
        $attributeGroups = $attributeGroups->whereIn('advertiser', ['applicant', 'both'])
            ->pluck('id')->toArray();

        $attributeGroups = $this->repo->attributeGroupsById($attributeGroups);
        return view('Applications::admin.create',
            compact('cities', 'category', 'attributeGroups', 'content'));
    }

    public function store(Request $request, $categoryId)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'city'=>'required',
            'phone'=>'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $category = $this->repo->findCategoryById($categoryId);
        if (!$category){
            Alert::error('', 'دسته بندی نامعتبر است');
            return redirect()->back();
        }

        if ($request->attribute != null) {
            foreach ($request->attribute as $key => $attribute) {
                if ((Attribute::where('id', $key)->first()->attribute_type=='int'
                        || Attribute::where('id', $key)->first()->attribute_type=='select')
                    && Attribute::where('id', $key)->first()->hasScale) {
                    if (Attribute::where('id', $key)->first()->isFilterField == 1
                        && (($attribute['min'] == null) || ($attribute['max'] == null))
                        && (Attribute::where('id', $key)->first()->attribute_type != 'bool')) {
                        return back()->with('message2', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' الزامی است.')->withInput();
                    }
                } else {
                    if (Attribute::where('id', $key)->first()->isFilterField == 1
                        && ($attribute == null) && (Attribute::where('id', $key)->first()->attribute_type != 'bool')) {
                        return back()->with('message2', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' الزامی است.')->withInput();
                    }
                }
            }
            foreach ($request->attribute as $key => $attribute) {
                if (Attribute::where('id', $key)->first()->isFilterField == 1) {
                    if ((Attribute::where('id', $key)->first()->attribute_type=='int'
                            || Attribute::where('id', $key)->first()->attribute_type=='select')
                        && Attribute::where('id', $key)->first()->hasScale) {
                        if (Attribute::where('id', $key)->first()->attribute_type == 'int'
                            && !(is_numeric($this->convertToEnglish(str_replace(',', '', $attribute['min'])))
                                && is_numeric($this->convertToEnglish(str_replace(',', '', $attribute['max']))))) {
                            if ($key==63)
                                dd($attribute);
                            return back()->with('message3', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' باید به صورت عدد وارد شود است.')->withInput();
                        }
                    } else {
                        if (Attribute::where('id', $key)->first()->attribute_type == 'int' && (!is_numeric(str_replace(',', '', $attribute)))) {
                            return back()->with('message3', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' باید به صورت عدد وارد شود است.')->withInput();
                        }
                    }
                } else {
                    if ((Attribute::where('id', $key)->first()->attribute_type=='int'
                            || Attribute::where('id', $key)->first()->attribute_type=='select')
                        && Attribute::where('id', $key)->first()->hasScale) {
                        if ($attribute['min'] != null && $attribute['max'] != null){
                            if (Attribute::where('id', $key)->first()->attribute_type == 'int'
                                && !(is_numeric($this->convertToEnglish(str_replace(',', '', $attribute['min'])))
                                    && is_numeric($this->convertToEnglish(str_replace(',', '', $attribute['max']))))) {
                                return back()->with('message3', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' باید به صورت عدد وارد شود است.')->withInput();
                            }
                        }
                    } else {
                        if ($attribute != null) {
                            if (Attribute::where('id', $key)->first()->attribute_type == 'int' && (!is_numeric(str_replace(',', '', $attribute)))) {
                                return back()->with('message3', 'مشخصه  ' . Attribute::where('id', $key)->first()->title . ' باید به صورت عدد وارد شود است.')->withInput();
                            }
                        }
                    }
                }
            }
        }
        $applicant = $this->storeApplicationWithAttrs($request, $category);
        $applicant->update([
            'active' => 'active',
        ]);
        if (isset($request->neighborhood)) {
            foreach ($request->neighborhood as $neighborhood) {
                ApplicationNeighborhood::create([
                    'application_id' => $applicant->id,
                    'neighborhood_id' => $neighborhood,
                    'created_user' => \auth()->id()
                ]);
            }
        }
        Alert::success('', 'درخواست با موفقیت ثبت شد');
        return redirect()->route('application.index.admin');
    }

    public function disconfirm()
    {
        $application = Application::find(request('adid'));
        if ($application) {
            $application->update([
                'active' => 'disConfirm',
                'activationReason' => request('appreason'),
            ]);
            return response()->json([
                'success' => '<div class="alert alert-success"  style="font-size: small"> با موفقیت ثبت شد</div>',
            ]);
        } else
            return response()->json([
                'error' => '<div class="alert alert-error"  style="font-size: small">درخواست موجود نیست.</div>',
            ]);
    }

    public function approve($applicationId)
    {
        $application = $this->repo->findApplicationById($applicationId);

        if ($application) {
            $application->update([
                'active' => 'active',
                'startDate'=>Carbon::now(),
                'endDate'=>Carbon::now()->add(Setting::where('title', 'duration_of_applications')->first()->str_value, 'day'),
            ]);
            return redirect()->back();
        } else
            return back();
    }

    public function destroy($applicationId)
    {
        $application = $this->repo->findApplicationById($applicationId);

        $application->update(['deleted_user'=>auth()->id()]);
        $application->delete();
        Alert::success(' ', 'درخواست با موفقیت حذف شد');
        return redirect()->route('application.index.admin');
    }
}

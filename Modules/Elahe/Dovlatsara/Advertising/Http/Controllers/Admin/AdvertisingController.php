<?php

namespace Modules\Advertising\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;
use Modules\Advertising\Entities\AdvertisingApplication;
use Modules\Advertising\Http\Requests\Admin\ApplyRequest;
use Modules\Advertising\Http\Requests\Admin\StoreRequest;
use Modules\Advertising\Http\Requests\Admin\UpdateRequest;
use Modules\Advertising\Repositories\AdvertisingRepository;
use Modules\AdminMasterNew\Http\Traits;
use Modules\Setting\Entities\Setting;
use Modules\User\Repositories\UserRepository;

class AdvertisingController extends Controller
{
    use Traits\UploadFileTrait;

    private $repo;
    private $userRepository;

    public function __construct(AdvertisingRepository $advertisingRepository, UserRepository $userRepository)
    {
        $this->repo = $advertisingRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $advertisings = $this->repo->advertisings();
        return view('Advertisings::admin.index', compact('advertisings'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $pageOrders = $this->repo->advertisingsOrders();
        return view('Advertisings::admin.create', compact('pageOrders'));

    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        $this->repo->create($request);
        \alert()->success('', 'تبلیغ با موفقیت ثبت شد.');
        return redirect(route('advertisings.index.admin'));

    }

    /**
     * @param $advertisingId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($advertisingId)
    {
        $advertising = $this->repo->advertisingFindById($advertisingId);
        $pageOrders = $this->repo->advertisingsOrders();
        return view('Advertisings::admin.edit', compact('advertising', 'pageOrders'));
    }

    /**
     * @param UpdateRequest $request
     * @param $advertisingId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateRequest $request, $advertisingId)
    {
        $this->repo->edit($request, $advertisingId);
        \alert()->success('', 'تبلیغ با موفقیت ویرایش شد.');
        return redirect(route('advertisings.index.admin'));
    }

    /**
     * @param $advertisingId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function inactive($advertisingId)
    {
        $this->repo->delete($advertisingId);
        \alert()->success('', 'تبلیغ با موفقیت حذف شد.');
        return redirect(route('advertisings.index.admin'));
    }

    /**
     * @param $advertisingId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function active($advertisingId)
    {
        $this->repo->active($advertisingId);
        \alert()->success('', 'تبلیغ با موفقیت فعال شد.');
        return redirect(route('advertisings.index.admin'));
    }

    /**
     * @param $advertisingId
     * @return array
     */
    public function endDateArray($advertisingId)
    {
        $array = [];
        foreach (AdvertisingApplication::where('advertising_id', $advertisingId)->where('isPaid', 1)->get() as $key => $application) {
            $array[$key + 1] = substr(Verta::parse($application->endDate)->formatDate(), 0, 7).'-'.$advertisingId.'-'.$application->category;
        }

        return $array;
    }

    /**
     * @param $advertisingId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function apply($advertisingId)
    {
        $array = $this->endDateArray($advertisingId);
        $advertising = $this->repo->advertisingFindById($advertisingId);
        $numberOfMonths = Setting::where('title', 'number_of_months')->first()->str_value;
        $flag = 0;
        $content = '';
        if ($advertising->advertisingOrder->page->hasCategory)
            $content.='برای انتخاب تاریخ ابتدا دسته بندی مورد نظر خود را انتخاب کنید';
        elseif ($advertising->advertisingOrder->page->hasUser)
            $content.='برای انتخاب تاریخ ابتدا کسب و کار مورد نظر خود را انتخاب کنید';
        else {
            for ($i = 0; $i <= $numberOfMonths + $flag; $i++) {
                if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertisingId.'-', $array) == false) {

                    $content .= '<label class="ml-3"><input type="radio" name="date" value="' . $i . '">' . Verta::now()->addMonths($i)->format('%B %Y') . ' </label>';
                } else {
                    $i = $i + 1;
                    $flag = $flag + 1;
                    if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7) . '-' . $advertisingId.'-', $array) == false) {

                        $content .= '<label class="ml-3"><input type="radio" name="date" value="' . $i . '">' . Verta::now()->addMonths($i)->format('%B %Y') . ' </label>';

                    } else {
                        $flag = $flag + 1;
                    }
                }
            }
        }
        $categories = $this->repo->categories();
        $agencies = $this->userRepository->usersFindByRole('real-state-administrator');

        return view('Advertisings::admin.apply', compact('advertising', 'content', 'categories', 'agencies'));

    }

    /**
     * @return false|string
     */
    public function getDates()
    {
        $advertising = $this->repo->advertisingFindById(\request('advertisingId'));
        $catId = \request('categoryId');
        $array = $this->endDateArray($advertising->id);
        $numberOfMonths = Setting::where('title', 'number_of_months')->first()->str_value;

        $flag = 0;
        $content = '';
        for ($i = 0; $i <= $numberOfMonths +$flag; $i++) {
            if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7).'-'.$advertising->id.'-'.$catId, $array) == false) {
                $content .= '<label class="ml-3"><input type="radio" name="date" value="' . $i . '">' . Verta::now()->addMonths($i)->format('%B %Y') . ' </label>';
            } else {
                $i = $i + 1;
                $flag = $flag + 1;
                if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7).'-'.$advertising->id.'-'.$catId, $array) == false) {

                    $content .= '<label class="ml-3"><input type="radio" name="date" value="' . $i . '">' . Verta::now()->addMonths($i)->format('%B %Y') . ' </label>';

                }else{
                    $flag = $flag + 1;
                }
            }
        }
        return json_encode(['status' => true, 'content' => $content]);
    }

    /**
     * @param $advertisingId
     * @return array
     */
    public function endDateArrayForUser($advertisingId): array
    {
        $array = [];
        foreach (AdvertisingApplication::where('advertising_id', $advertisingId)->where('isPaid', 1)->get() as $key => $application) {
            $array[$key + 1] = substr(Verta::parse($application->endDate)->formatDate(), 0, 7).'-'.$advertisingId.'-'.$application->user;
        }
        return $array;
    }

    /**
     * @return false|string
     */
    public function getDatesForUser()
    {
        $advertising = $this->repo->advertisingFindById(\request('advertisingId'));
        $userId = \request('userId');
        $array = $this->endDateArrayForUser($advertising->id);
        $numberOfMonths = Setting::where('title', 'number_of_months')->first()->str_value;
        $flag = 0;
        $content = '';
        for ($i = 0; $i <= $numberOfMonths +$flag; $i++) {
            if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7).'-'.$advertising->id.'-'.$userId, $array) == false) {
                $content .= '<label class="ml-3"><input type="radio" name="date" value="' . $i . '">' . Verta::now()->addMonths($i)->format('%B %Y') . ' </label>';
            } else {
                $i = $i + 1;
                $flag = $flag + 1;
                if (array_search(substr(Verta::now()->addMonths($i)->formatDate(), 0, 7).'-'.$advertising->id.'-'.$userId, $array) == false) {

                    $content .= '<label class="ml-3"><input type="radio" name="date" value="' . $i . '">' . Verta::now()->addMonths($i)->format('%B %Y') . ' </label>';

                }else{
                    $flag = $flag + 1;
                }
            }
        }
        return json_encode(['status' => true, 'content' => $content]);
    }

    /**
     * @param ApplyRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function applySubmit(ApplyRequest $request)
    {
        if ($request->file('image')) {
            $image = $this->uploadFile($request->file('image'), 'public/upload/advertisement/image/' . now()->year
                . '/' . now()->month);
        } else
            $image = null;
        if ($request->file('responsiveImage')) {
            $responsiveImage = $this->uploadFile($request->file('responsiveImage'), 'public/upload/advertisement/responsiveImage/' . now()->year
                . '/' . now()->month);
        } else
            $responsiveImage = null;
        AdvertisingApplication::create([
            'user_id' => auth()->id(),
            'advertising_id' => $request->advertising_id,
            'link' => $request->link,
            'startDate' => Verta::now()->addMonths($request->date)->startMonth(),
            'endDate' => Verta::now()->addMonths($request->date)->endMonth(),
            'image' => $image,
            'image_title' => $request->file('image')->getClientOriginalName(),
            'responsive_image' => $responsiveImage,
            'responsive_image_title' => $request->file('responsiveImage')->getClientOriginalName(),
            'category' =>$request->category,
            'user' =>$request->user,
            'active'=>1,
            'isPaid'=>1,
            'created_user' => auth()->id()
        ]);
        \alert()->success('', 'تبلیغ با موفقیت رزرو شد.');
        return redirect(route('advertisings.index.admin'));
    }

}

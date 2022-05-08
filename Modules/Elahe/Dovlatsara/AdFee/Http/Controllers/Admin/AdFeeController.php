<?php

namespace Modules\AdFee\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\AdFee\Entities\AdFee;
use Modules\AdFee\Repositories\AdFeeRepository;
use Modules\AdvertisingFee\Http\Requests\Admin\StoreRequest;
use Modules\AdvertisingFee\Http\Requests\Admin\UpdateRequest;
use Modules\Category\Entities\Category;
use RealRashid\SweetAlert\Facades\Alert;

class AdFeeController extends Controller
{
    public $repo;
    public $hasSpecial;
    public $hasScalar;
    public $hasEmergency;

    public function __construct(AdFeeRepository $adFeeRepository)
    {
        $this->repo = $adFeeRepository;
        $this->hasSpecial = $this->repo->adminSetting('hasSpecial');
        $this->hasScalar = $this->repo->adminSetting('hasScalar');
        $this->hasEmergency = $this->repo->adminSetting('hasEmergency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $adFees = AdvertisingFee::all();
//        return view('AdvertisingFees::admin.index', compact('adFees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $adFee = $this->repo->create($request);
        Alert::success('', 'هزینه با موفقیت ثبت شد');
        return redirect()->route('advertisingFee.index.admin', $adFee->category_id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

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
        $adFee = $this->repo->adFeeFindById($id);
        return view('AdFees::admin.edit', compact('adFee', 'hasSpecial', 'hasScalar', 'hasEmergency'));
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
        $adFee = $this->repo->adFeeFindById($id);
        $this->repo->update($id, $request);
        Alert::success('', 'هزینه با موفقیت ویرایش شد');
        return redirect()->route('advertisingFee.index.admin', $adFee->category_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->repo->delete($id);
        Alert::success('', 'هزینه با موفقیت حذف شد.');
        return redirect()->back();
    }

    /**
     * Show the lis of AdFees.
     *
     * @param $categoryId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function showAdvertisingFees($categoryId)
    {
        if (Category::find($categoryId)->node==0){
            alert()->error('', 'دسته بندی انتخاب شده غیرمجاز است');
            return redirect()->back();
        }
        $hasSpecial = $this->hasSpecial;
        $hasScalar = $this->hasScalar;
        $hasEmergency = $this->hasEmergency;
        $adFees = $this->repo->adFeesFindByCatId($categoryId);
        $category = $this->repo->categoryFindById($categoryId);
        return view('AdFees::admin.index', compact('adFees', 'category', 'hasEmergency', 'hasScalar', 'hasSpecial'));
    }

    /**
     * Show the lis of AdFees.
     *
     * @param $categoryId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function addAdvertisingFee($categoryId)
    {
        if (Category::find($categoryId)->node==0){
            alert()->error('', 'دسته بندی انتخاب شده غیرمجاز است');
            return redirect()->back();
        }
        $hasSpecial = $this->hasSpecial;
        $hasScalar = $this->hasScalar;
        $hasEmergency = $this->hasEmergency;
        $category = $this->repo->categoryFindById($categoryId);
        return view('AdFees::admin.create', compact('category', 'hasEmergency', 'hasScalar', 'hasSpecial'));
    }

}

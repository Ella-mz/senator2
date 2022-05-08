<?php

namespace Modules\EnumType\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\EnumType\Repositories\EnumTypeRepository;
use RealRashid\SweetAlert\Facades\Alert;


class MembershipReductionScoreController extends Controller
{
    private $enumTypeRepository;

    public function __construct(EnumTypeRepository $enumTypeRepository)
    {
        $this->enumTypeRepository = $enumTypeRepository;
    }

    public function index()
    {
        $membership_reduction_scores = $this->enumTypeRepository->findEnumTypesByEnumTitle('membership_reduction_score');
        return view('EnumTypes::admin.membershipReductionScore.index', compact('membership_reduction_scores'));
    }

    public function edit($enumTypeId)
    {
        $membershipReductionScore = $this->enumTypeRepository->findEnumTypeById($enumTypeId);
        return view('EnumTypes::admin.membershipReductionScore.edit', compact('membershipReductionScore'));
    }

    public function update(Request $request, $enumTypeId)
    {
        $validator = Validator::make($request->all(), [
            'score' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $membershipReductionScore = $this->enumTypeRepository->findEnumTypeById($enumTypeId);
            $membershipReductionScore->update([
                'link' => $request->score,
            ]);
        Alert::success('', 'درخواست شما با موفقیت ثبت شد');
        return redirect(route('membership_reduction_score.index.admin'));
    }
}

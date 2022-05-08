<?php

namespace Modules\AssociationSkill\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\AssociationSkill\Entities\AssociationSkill;
use Modules\AssociationSkill\Repositories\AssociationSkillRepository;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\AdminMasterNew\Http\Traits;

class AssociationSkillController extends Controller
{
    use Traits\UploadFileTrait;

    public $repo;

    public function __construct(AssociationSkillRepository $associationSkillRepository)
    {
        $this->repo = $associationSkillRepository;
    }

    public function index($associationId)
    {
        $association = $this->repo->findAssociationById($associationId);
        $associationSkills = $this->repo->getAssociationSkillsByAssociationId($associationId);
        return view('AssociationSkills::admin.index', compact('associationSkills', 'association'));
    }

    public function create($associationId)
    {
        $association = $this->repo->findAssociationById($associationId);
        $associationSkills = $this->repo->associationSkills();
        return view('AssociationSkills::admin.create', compact('associationSkills', 'association'));

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->file('image')) {
            $image = $this->uploadFile($request->file('image'), 'public/upload/associationSkill/image/' . now()->year
                . '/' . now()->month);
        }else
            $image=null;

        $associationSkill = $this->repo->create($request, $image);

        Alert::success('', 'مهارت با موفقیت ثبت شد');
        return redirect()->route('associationSkills.index.admin', $associationSkill->association_id);
    }

    public function edit($associationSkillId)
    {
        $associationSkill = $this->repo->findAssociationSkillById($associationSkillId);
        return view('AssociationSkills::admin.edit', compact('associationSkill'));

    }

    public function update(Request $request, $associationSkillId)
    {
        $associationSkill = $this->repo->findAssociationSkillById($associationSkillId);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->file('image')) {
            $image = $this->uploadFile($request->file('image'), 'public/upload/associationSkill/image/' . now()->year
                . '/' . now()->month);
        }else
            $image = $associationSkill->image;

        $this->repo->update($associationSkillId, $request, $image);
        Alert::success('', 'مهارت با موفقیت ویرایش شد');
        return redirect()->route('associationSkills.index.admin', $associationSkill->association_id);
    }

    public function destroy($associationSkillId)
    {
        $this->repo->delete($associationSkillId);
        Alert::success(' ', 'مهارت با موفقیت حذف شد');
        return redirect()->back();
    }

    public function deleteFile(Request $request): JsonResponse
    {
        $skill = $this->repo->findAssociationSkillById($request->id);
        unlink($skill->image);
        $skill->update(['image'=> null,]);
        return response()->json(['success'=>true]);
    }
}

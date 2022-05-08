<?php

namespace Modules\ContractorProject\Http\Controllers\Realestate;

use App\Http\Controllers\Controller;
use Modules\ContractorProject\Entities\ContractorProject;
use Modules\ContractorProject\Http\Requests\Realestate\StoreRequest;
use Modules\ContractorProject\Http\Requests\Realestate\UpdateRequest;
use Modules\ContractorProjectImage\Entities\ContractorProjectImage;
use Modules\AdminMasterNew\Http\Traits;

class ContractorProjectController extends Controller
{
    use Traits\UploadFileTrait;

    public function index()
    {
        $con_projects = ContractorProject::where('user_id', auth()->id())->orderByDesc('created_at')->get();
        return view('ContractorProjects::realestate.index', compact('con_projects'));

    }

    public function create()
    {
        return view('ContractorProjects::realestate.create');

    }

    public function store(StoreRequest $request)
    {
        $con_project = ContractorProject::create([
           'title'=>$request->title,
            'description' => $request->description,
            'user_id' =>\auth()->id(),
            'created_user'=>\auth()->id()
        ]);
        if ($request['images']) {
            foreach ($request['images'] as $image) {
                if ($image != null) {
                    $im = $this->uploadFile($image, 'public/upload/contractorProject/' . now()->year
                        . '/' . now()->month . '/' . $con_project->id);
                    $conProjectImage = ContractorProjectImage::create([
                        'contractor_project_id' => $con_project->id,
                        'image' => $im,
                        'created_user' => \auth()->id()
                    ]);
                }
            }
        }
        \alert()->success('', 'پروژه شما با موفقیت ثبت شد');
        return redirect(route('contractorProject.index.realestate'));
    }

    public function edit(ContractorProject $contractorProject)
    {
        return view('ContractorProjects::realestate.edit', compact('contractorProject'));

    }

    public function update(UpdateRequest $request, ContractorProject $contractorProject)
    {
        if (auth()->id()!=$contractorProject->user_id) {
            \alert()->success('', 'اجازه دسترسی به این پروژه را ندارید');
            return redirect()->back();
        }
        $contractorProject->update([
            'title'=>$request->title,
            'description' => $request->description,
            'user_id' =>\auth()->id(),
            'updated_user'=>\auth()->id()
        ]);
        if ($request['images']) {
            foreach ($contractorProject->contractorProjectImages()->get() as $image) {
                $image->delete();
            }
            foreach ($request['images'] as $image) {
                if ($image != null) {
                    $im = $this->uploadFile($image, 'public/upload/contractorProject/' . now()->year
                        . '/' . now()->month . '/' . $contractorProject->id);
                    $conProjectImage = ContractorProjectImage::create([
                        'contractor_project_id' => $contractorProject->id,
                        'image' => $im,
                        'created_user' => \auth()->id()
                    ]);
                }
            }
        }
        \alert()->success('', 'پروژه شما با موفقیت ویرایش شد');
        return redirect(route('contractorProject.index.realestate'));
    }

    public function destroy(ContractorProject $contractorProject)
    {
        if (auth()->id()!=$contractorProject->user_id) {
            \alert()->success('', 'اجازه دسترسی به این پروژه را ندارید');
            return redirect()->back();
        }
        $contractorProject->delete();
        \alert()->success('', 'پروژه شما با موفقیت حذف شد');
        return redirect(route('contractorProject.index.realestate'));
    }
}

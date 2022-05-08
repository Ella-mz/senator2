<?php

namespace Modules\Association\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Modules\Association\Entities\Association;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\AdminMasterNew\Http\Traits;

class AssociationController extends Controller
{
    use Traits\UploadFileTrait;

    public function showAssociations($parentId)
    {
        $associations = Association::where('parent_id', $parentId)->get();
        $associationSelected = $parentId == 0 ? "" : Association::find($parentId)->title;
        $parent = $parentId;
        $map = '';
        while ($parentId > 0) {
            $association = Association::findOrFail($parentId);
            $route = route('associations.index.admin', $association->id);
            $map = '<a href="' . $route . '">' . $association->title . '</a>' . ' > ' . $map;
            $parentId = $association->parent_id;
        }
        $map = '<a href="' . route('associations.index.admin', 0) . '">اصناف</a>' . ' > ' . $map;
        $parentId = $parent;
//        dd($parentId,$map,$categorySelected=="",$categories);

        return view('Associations::admin.index',
            compact('associations', 'associationSelected', 'parentId', 'map'));
    }

    public function addAssociation($parentId)
    {
        $association = $parentId != 0 ? Association::findOrFail($parentId) : null;

        return view('Associations::admin.create', compact('association',
            'parentId'));
    }


    public function getPath($parentId)
    {
        if ($parentId == 0)
            $current_path = null;
        else {
            $parentPath = Association::find($parentId)->path;
            $current_path = is_null($parentPath) ? $parentId : $parentPath . ',' . $parentId;
        }
        return $current_path;
    }

    public function storeAssociation(Request $request)
    {
//        dd(($request->parentId2));
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->parentId2 == 0 || Association::where('id', $request->parentId2)->first()->depth + 1 <= 2) {
            $association = Association::create(
                [
                    'parent_id' => $request->parentId2,
                    'title' => $request->title,
                    'depth' => $request->parentId2 == 0 ? 1 : Association::find($request->parentId2)->depth + 1,
                    'path' => $this->getPath($request->parentId2),
                    'created_user' => Auth::id(),
                ]
            );
            if ($request->file('image')) {
                $image = $this->uploadFile($request->file('image'), 'public/upload/association/image/' . now()->year
                    . '/' . now()->month);
                $association->update(['image' => $image,]);
            }

        } else {
            Alert::error('امکان ایجاد صنف نیست.', 'اصناف دارای یک مرحله زیرمجموعه هستند');
            return redirect()->route('associations.index.admin', $request->parentId2);
        }
        if ($request->parentId2 != 0) {
            if (Association::findOrFail($request->parentId2)) {
                if (Association::findOrFail($request->parentId2)->node == 1) {
                    Association::findOrFail($request->parentId2)->update(['node' => 0]);
                }
            }
        }
        Alert::success('', 'صنف با موفقیت ثبت شد');
        return redirect()->route('associations.index.admin', $request->parentId2);
    }

    public function ediAssociation($asscociation)
    {
        $association = Association::find($asscociation);
        return view('Associations::admin.edit', compact('association'));

    }

    public function updateAssociation(Request $request, Association $association)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->file('image')) {
            File::delete(public_path($association->image));
            $image = $this->uploadFile($request->file('image'), 'public/upload/association/image/' . now()->year
                . '/' . now()->month);
            $association->update([
                'image' => $image,
            ]);
        }
        $association->update(
            [
                'title' => $request->title,
                'updated_user' => Auth::id(),
            ]
        );
        Alert::success(' ', 'صنف با موفقیت ویرایش شد');
        return redirect()->route('associations.index.admin', $association->parent_id);
    }

    public function getAllLastNode()
    {
        $associations = Association::all();
        $nodes = [];
        foreach ($associations as $key => $association) {
            if (!Association::where('parent_id', $association->id)->first())
                $nodes[$key] = $association->id;
        }
        return $nodes;
    }

    public function getLastNode($association)
    {
        $nodes = $this->getAllLastNode();
        $nodes = Association::whereIn('id', $nodes)->get();
        $childArray = [];
        foreach ($nodes as $key => $node) {
//            $parents = explode(',', $node->path);
//
//            if (in_array($category->id, $parents))
//                $childArray[$key] = $node->id;
            if ($node->path != null) {
                $parents = explode(',', $node->path);

                if (in_array($association->id, $parents))
                    $childArray[$key] = $node->id;
            } else {
                if (($association->id == $node->id))
                    $childArray[$key] = $node->id;
            }
        }
        return $childArray;
    }

    public function destroyInterfacesOfAssociation($association)
    {
        $association->users()->detach();
        foreach ($association->associationSkills as $associationSkill) {
            $associationSkill->users()->detach();
            $associationSkill->update(['deleted_user' => \auth()->id()]);
            $associationSkill->delete();
        }
        if ($association->association->subAssociations->count() > 1) {
//            File::delete(public_path($association->image));
            $association->update(['deleted_user' => \auth()->id()]);
            $association->delete();
            return true;
//            Alert::success(' ', 'صنف با موفقیت حذف شد');
//            return redirect()->back();
        }else{
            $parentAssociation = Association::where('id', $association->association->id)->first();
            $parentAssociation->update([
                'node' => 1,
                'updated_user'=>\auth()->id(),
            ]);
//            File::delete(public_path($association->image));
            $association->update(['deleted_user' => \auth()->id()]);
            $association->delete();
            return true;
        }
    }

    public function destroyAssociation($association)
    {
        $association = Association::find($association);
        if ($association->parent_id==0 && $association->node==1){
//            File::delete(public_path($association->image));
            $association->update(['deleted_user' => \auth()->id()]);
            $association->delete();
            Alert::success(' ', 'صنف با موفقیت حذف شد');
            return redirect()->back();
        }
        if ($association->node == 1) {
            $status = $this->destroyInterfacesOfAssociation($association);
            if ($status==true){
                Alert::success(' ', 'صنف با موفقیت حذف شد');
                return redirect()->back();
            }else{
                Alert::error(' ', 'صنف حذف نشد');
                return redirect()->back();
            }
        }else{
            foreach ($association->subAssociations as $subAssociation){
                $status = $this->destroyInterfacesOfAssociation($subAssociation);
            }
            $association->update(['deleted_user' => \auth()->id()]);
            $association->delete();
            Alert::success(' ', 'صنف با موفقیت حذف شد');
            return redirect()->back();
        }
    }

    public function deleteFile(Request $request): JsonResponse
    {
        $association = Association::find($request->id);
        unlink($association->image);
        $association->update(['image' => null,]);
        return response()->json(['success' => true]);
    }
}

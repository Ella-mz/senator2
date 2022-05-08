<?php

namespace Modules\RoleAndPermissionNew\Http\Controllers\Admin;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Modules\RoleAndPermissionNew\Entities\PermissionNew;
use Modules\RoleAndPermissionNew\Entities\RoleNew;
use Modules\AdminMasterNew\Http\Traits;

class RoleController extends Controller
{
    use Traits\UploadFileTrait;

    public function convertToEnglish($string)
    {
        if ($string == null)
            return null;
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        //dd(str_replace($persian, $newNumbers, $string));
        return str_replace($persian, $newNumbers, $string);
    }

    /**
     * it shows all attributes.
     *
     * @return View
     */
    protected function index(): View
    {

        $roles = RoleNew::where('show', 1)->get();
        $permissions = PermissionNew::where('show', 1)->get();

        return view('RoleAndPermissionNew::fa.admin.index',
            compact('roles', 'permissions'));
    }

    public function create(): View
    {
        $permissions = PermissionNew::where('show', 1)->get();

        return view('RoleAndPermissionNew::fa.admin.create', compact('permissions'));
    }

    /**
     * it saves the create item.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|max:20|string|unique:roles',
            'enName' => 'required|min:3|max:20|string|unique:roles'
        ]);
        $role = RoleNew::create([
            'name' => $request['name'],
            'enName' => $request['enName'],
        ]);

        if (isset($request->permissions)) {
            foreach ($request->permissions as $permission) {
                $role->permissions()->attach($permission);
            }
        }
        return redirect()->route('roles.index')
            ->with('success', 'Item create successfully.');
    }

    public function edit($roleId)
    {
        $permissions = PermissionNew::where('show', 1)->get();

        $role = RoleNew::whereId($roleId)->first();
        return view('RoleAndPermissionNew::fa.admin.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $roleId)
    {
        $role = RoleNew::find($roleId);
        $role->name = $request['name'];
        $role->enName = $request['enName'];
        $role->slug = null;
        $role->save();

        if (isset($request->permissions)){
            $role->permissions()->detach();
            foreach ($request->permissions as $permission) {
                $role->permissions()->attach($permission);
            }
        }
        return redirect()->route('roles.index')
            ->with('success', 'Item update successfully.');
    }

    public function destroy($roleId)
    {
        $role = RoleNew::whereId($roleId)->first();
        $role->permissions()->detach();
        $role->delete();
        alert()->success('', 'نقش با موفقیت حذف شد');
        return redirect()->back();
    }

    public function fetchPermission(Request $request): \Illuminate\Http\JsonResponse
    {
        $role = RoleNew::where('slug', $request->role)->first();
        $permissions = $role->permissions;
        if (empty($permissions)) {
            return response()->json(['status' => false, 'message' => 'empty']);
        }
        return response()->json(['status' => true, 'data' => $permissions]);
    }

    public function assignPermission(Request $request): \Illuminate\Http\JsonResponse
    {
        $role = RoleNew::where('slug', $request->role)->first();
        $permissions = PermissionNew::where('slug', $request->permission)->first();

        $boolStrVar1 = filter_var($request->checkinput, FILTER_VALIDATE_BOOLEAN);

        if ($boolStrVar1) {
            $sync = $role->permissions()->attach($permissions->id);
        } else {
            $sync = $role->permissions()->detach($permissions->id);
        }
        $message = is_null($sync) ? 'Permission added to role' : 'Permission remove from role';
        return response()->json(['status' => true, 'message' => $message]);
    }
}

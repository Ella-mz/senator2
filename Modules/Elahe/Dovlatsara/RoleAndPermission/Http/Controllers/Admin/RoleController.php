<?php

namespace Modules\RoleAndPermission\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Modules\RoleAndPermission\Entities\Permission;
use Modules\RoleAndPermission\Entities\Role;

class RoleController extends Controller
{
    /**
     * it shows all attributes.
     *
     * @return View
     */
    protected function index(): View
    {

        $roles = Role::where('show', 1)->get();
        $permissions = Permission::where('show', 1)->get();

        return view('RoleAndPermissions::fa.admin.index',
            compact('roles','permissions'));
    }

    public function create():View
    {
        return view('RoleAndPermissions::fa.admin.create');
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
            'name'=>'required|min:3|max:20|string|unique:roles',
            'enName'=>'required|min:3|max:20|string|unique:roles'
        ]);
        Role::create([
            'name' => $request['name'],
            'enName' => $request['enName'],

        ]);
        return redirect()->route('role.index')
            ->with('success', 'Item create successfully.');
    }

    public function edit($request)
    {
        $id = filter_var($request, FILTER_VALIDATE_INT);

        $role = Role::whereId($id)->first();
        return view('RoleAndPermissions::fa.admin.edit',compact('role'));
    }
    public function update(Request $request, $role)
    {
        $id = filter_var($role, FILTER_VALIDATE_INT);

        $role = Role::find($id);
        $role->name = $request['name'];
        $role->enName = $request['enName'];
        $role->slug = null;
        $role->save();

        $roles = Role::all();
        $permissions = Permission::all();

        return view('RoleAndPermissions::fa.admin.index',
            compact('roles','permissions'));
    }
    public function destroy(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $id = filter_var($request->id, FILTER_VALIDATE_INT);

        $role = Role::whereId($id)->first();
        $role->delete();
        return response()->json(['status'=>true ,'message'=>'Role has been Deleted']);
    }
    public function fetchPermission(Request $request): \Illuminate\Http\JsonResponse
    {
        $role = Role::where('slug',$request->role)->first();
        $permissions = $role->permissions;
        if(empty($permissions)){
            return response()->json(['status'=>false,'message'=>'empty']);
        }
        return response()->json(['status'=>true,'data'=>$permissions]);
    }

    public function assignPermission(Request $request): \Illuminate\Http\JsonResponse
    {
        $role = Role::where('slug',$request->role)->first();
        $permissions = Permission::where('slug',$request->permission)->first();

        $boolStrVar1 = filter_var($request->checkinput, FILTER_VALIDATE_BOOLEAN);

        if($boolStrVar1){
            $sync = $role->permissions()->attach($permissions->id);
        }else{
            $sync = $role->permissions()->detach($permissions->id);
        }
        $message = is_null($sync) ? 'Permission added to role' : 'Permission remove from role';
        return response()->json(['status'=>true ,'message'=>$message]);
    }
}

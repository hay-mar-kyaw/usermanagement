<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\{Role,Permission};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Control the permission with role
     */
    public function __construct(){
        $this->middleware('permission:view role',['only'=>['index']]);
        $this->middleware('permission:create role',['only'=>['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update role',['only'=>['update','edit']]);
        $this->middleware('permission:delete role',['only'=>['destroy']]);
    }
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::all();
        return view('role-permission.roles.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role-permission.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name'
            ]
            ]);
            Role::create($data);
            return redirect()->route('roles.index')->with('status','Role created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=Role::findOrFail($id);
        return view('role-permission.roles.edit',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $data=$request->validate([
            'name'=>[
                'required',
                'string',
                'unique:roles,name,'.$role->id
                ]
            ]);
            $role->update($data);
            return redirect()->route('roles.index')->with('status','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role=Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('status','Role deleted successfully');

    }


    //Add or Edit Permission to Role
    public function addPermissionToRole($roleId)
    {
        $permissions=Permission::all();
        $role=Role::findOrFail($roleId);
        $rolePermissions=DB::table('role_has_permissions')
                            ->where('role_has_permissions.role_id',$role->id)
                            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                            ->all();
        return view('role-permission.roles.add-permissions',['role'=>$role,'permissions'=>$permissions,'rolePermissions'=>$rolePermissions]);

    }

    //Give Permission to Role
    public function givePermissionToRole(Request $request,$roleId)
    {
        $request->validate([
            'permission'=>'required'
        ]);

        $role=Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('status','Permission added to role');
    }
}

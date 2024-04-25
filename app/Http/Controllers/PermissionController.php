<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Control the permission with role
     */
    public function __construct(){
        $this->middleware('permission:view permission',['only'=>['index']]);
        $this->middleware('permission:create permission',['only'=>['create','store']]);
        $this->middleware('permission:update permission',['only'=>['update','edit']]);
        $this->middleware('permission:delete permission',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions=Permission::all();
        return view('role-permission.permissions.index',['permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role-permission.permissions.create');
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
                'unique:permissions,name'
            ]
            ]);
            Permission::create($data);
            return redirect()->route('permissions.index')->with('status','Permission created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission=Permission::findOrFail($id);
        return view('role-permission.permissions.edit',['permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $data=$request->validate([
            'name'=>[
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
                ]
            ]);
            $permission->update($data);
            return redirect()->route('permissions.index')->with('status','Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission=Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions.index')->with('status','Permission deleted successfully');

    }
}

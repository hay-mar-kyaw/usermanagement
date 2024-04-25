<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Control the permission with role
     */
    public function __construct(){
        $this->middleware('permission:view user',['only'=>['index']]);
        $this->middleware('permission:create user',['only'=>['create','store']]);
        $this->middleware('permission:update user',['only'=>['update','edit']]);
        $this->middleware('permission:delete user',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::all();
        return view('role-permission.users.index',['users'=>$users]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::pluck('name','name')->all();
        return view('role-permission.users.create',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data=$request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required',
            'roles' => 'required',
            'phone' => 'required',
            'email' => 'required|email|max:255|unique:users,email',
            'address' => 'required',
            'password' => 'required|string|max:20',
            'gender' => 'required',
            'is_active' => 'required',
        ]);


       $user= User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'password' =>Hash::make($request->password),
            'gender' => $request->gender,
            'is_active' => $request->is_active,
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('status','User created successfully with role');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles=Role::pluck('name','name')->all();
        $user=User::findOrFail($id);
        $userRoles=$user->roles->pluck('name','name')->all();
        return view('role-permission.users.edit',['roles'=>$roles,'user'=>$user,'userRoles'=>$userRoles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'nullable|string|max:20',
            'is_active' => 'required',
        ]);

        $data=[
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => $request->is_active,
        ];

        if(!empty($request->password)){
            $data +=[
                'password' =>Hash::make($request->password),
            ];
        }
        $user=User::findOrFail($id);
        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('status','User updated successfully with role');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('status','User deleted successfully');
    }
}

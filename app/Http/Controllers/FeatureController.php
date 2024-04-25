<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feature;

class FeatureController extends Controller
{
    /**
     * Control the permission with role
     */
    public function __construct(){
        $this->middleware('permission:view feature',['only'=>['index']]);
        $this->middleware('permission:create feature',['only'=>['create','store']]);
        $this->middleware('permission:update feature',['only'=>['update','edit']]);
        $this->middleware('permission:delete feature',['only'=>['destroy']]);
    }

     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features=Feature::all();
        return view('role-permission.features.index',['features'=>$features]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role-permission.features.create');
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
                'unique:features,name'
            ]
            ]);
            Feature::create($data);
            return redirect()->route('features.index')->with('status','Feature created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feature=Feature::findOrFail($id);
        return view('role-permission.features.edit',['feature'=>$feature]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $data=$request->validate([
            'name'=>[
                'required',
                'string',
                'unique:features,name,'.$feature->id
                ]
            ]);
            $feature->update($data);
            return redirect()->route('features.index')->with('status','Feature updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature=Feature::findOrFail($id);
        $feature->delete();

        return redirect()->route('features.index')->with('status','Feature deleted successfully');

    }
}

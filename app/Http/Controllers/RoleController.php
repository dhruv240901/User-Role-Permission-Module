<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles=Role::withTrashed()->get();
        return view('role.list',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions=Permission::all();
        return view('role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rolename'    =>'required',
            'description' =>'required',
            'permissions' =>'required'
        ]);

        $insertdata=[
            'name'        =>$request->rolename,
            'description' =>$request->description,
            'created_by'  =>auth()->id()
        ];

        $role=Role::create($insertdata);
        if($request->permissions){
            foreach($request->permissions as $key => $permissionId){
                $role->permissions()->attach($request->permissions[$key]);
            }
        }

        return redirect()->route('add-role')->with('success','Role Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role=Role::findOrFail($id);
        return view('role.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissions=Permission::all();
        $role=Role::findOrFail($id);
        return view('role.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role=Role::findOrFail($id);
        $request->validate([
            'rolename'    =>'required',
            'description' =>'required',
            'permissions' =>'required'
        ]);

        $updatedata=[
            'name'        =>$request->rolename,
            'description' =>$request->description,
            'updated_by'  =>auth()->id()
        ];

        $roleupdate=$role->update($updatedata);

        if($request->permissions){

            foreach ($role->permissions as $key => $permissionId) {
                $role->permissions()->detach($role->permissions[$key]);
            }

            foreach($request->permissions as $key => $permissionId){
                $role->permissions()->attach($request->permissions[$key]);
            }
        }
        return redirect()->route('edit-role',$id)->with('success','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role=Role::findOrFail($id);
        $role->delete();
        $role->update(['deleted_by'=>auth()->id(),'is_deleted'=>'1']);
        return redirect()->route('role-list')->with('success','Role Soft Deleted Successfully');
    }

    public function restore($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->restore();
        $role->update(['deleted_by'=>null,'is_deleted'=>'0']);
        return redirect()->route('role-list')->with('success','Role Restored Successfully');
    }

    public function forceDelete($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->forceDelete();
        return redirect()->route('role-list')->with('success','Role Permanently Deleted Successfully');
    }

    public function updatestatus(Request $request)
    {
        $role=Role::findOrFail($request->id);
        if($request->checked=="false"){
            $role->update(['is_active'=>0]);
        }
        if($request->checked=="true"){
            $role->update(['is_active'=>1]);
        }
    }
}

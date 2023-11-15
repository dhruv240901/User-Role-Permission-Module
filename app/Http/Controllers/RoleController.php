<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /* function to display roles list */
    public function index()
    {
        $roles=Role::withTrashed()->get();
        return view('role.list',compact('roles'));
    }

    /* function to render add role form */
    public function create()
    {
        $permissions=Permission::all();
        return view('role.create',compact('permissions'));
    }

    /* function to store role in database */
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

    /* function to show role details by id */
    public function show(string $id)
    {
        $role=Role::findOrFail($id);
        return view('role.show',compact('role'));
    }

    /* function to render edit role form */
    public function edit(string $id)
    {
        $permissions=Permission::all();
        $role=Role::findOrFail($id);
        return view('role.edit',compact('role','permissions'));
    }

    /* function to update role */
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

    /* function to soft delete role */
    public function destroy(string $id)
    {
        $role=Role::findOrFail($id);
        $role->delete();
        $role->update(['deleted_by'=>auth()->id(),'is_deleted'=>'1']);
        return redirect()->route('role-list')->with('success','Role Soft Deleted Successfully');
    }

    /* function to restore role */
    public function restore($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->restore();
        $role->update(['deleted_by'=>null,'is_deleted'=>'0']);
        return redirect()->route('role-list')->with('success','Role Restored Successfully');
    }

    /* function to force delete role */
    public function forceDelete($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->forceDelete();
        return redirect()->route('role-list')->with('success','Role Permanently Deleted Successfully');
    }

    /* function to update role status */
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

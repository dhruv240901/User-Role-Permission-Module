<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Module;
use App\Models\PermissionModule;

class PermissionController extends Controller
{
    /* function to display permissions list */
    public function index()
    {
        $permissions=Permission::withTrashed()->get();
        return view('permission.list',compact('permissions'));
    }

    /* function to render add permission form */
    public function create()
    {
        $modules=Module::all();
        return view('permission.create',compact('modules'));
    }

    /* function to store permission in database */
    public function store(Request $request)
    {
        $request->validate([
            'permissionname' =>'required',
            'description'    =>'required',
        ]);

        $insertdata=[
            'name'        =>$request->permissionname,
            'description' =>$request->description,
            'created_by'  =>auth()->id()
        ];

        $permission=Permission::create($insertdata);

        $modules=Module::all();

        $insertmoduledata=array();
        foreach($modules as $k=>$value){
            if($request[$value->name]){
                $insertmoduledata=[
                    'permission_id'=>$permission->id,
                    'module_id'    =>$value->id
                ];
                foreach($request[$value->name] as $key => $value){
                    if($value=='add'){
                        $insertmoduledata['add_access']='1';
                    }
                    if($value=='view'){
                        $insertmoduledata['view_access']='1';
                    }
                    if($value=='modify'){
                        $insertmoduledata['edit_access']='1';
                    }
                    if($value=='delete'){
                        $insertmoduledata['delete_access']='1';
                    }
                }
                PermissionModule::create($insertmoduledata);
            }
        }

        return redirect()->route('add-permission')->with('success','Role Created Successfully');
    }

    /* function to show permission details by id */
    public function show(string $id)
    {
        $permission=Permission::findOrFail($id);
        $modules=Module::all();
        $permissionmodules=PermissionModule::where('permission_id',$id)->get();
        return view('permission.show',compact('permission','modules','permissionmodules'));
    }

    /* function to render edit permission form */
    public function edit(string $id)
    {
        $modules=Module::all();
        $permission=Permission::findOrFail($id);
        return view('permission.edit',compact('permission','modules'));
    }

    /* function to update permission */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'permissionname' =>'required',
            'description'    =>'required',
        ]);

        $updatedata=[
            'name'        =>$request->permissionname,
            'description' =>$request->description,
            'updated_by' =>auth()->id()
        ];

        $permission=Permission::findOrFail($id);
        $permission->update($updatedata);

        $permissionmodules=PermissionModule::where('permission_id',$id)->get();
        foreach($permissionmodules as $k=>$permissionmodule){
            $permissionmodule->delete();

        }

        $modules=Module::all();

        $insertmoduledata=array();
        foreach($modules as $k=>$value){
            if($request[$value->name]){
                $insertmoduledata=[
                    'permission_id'=>$permission->id,
                    'module_id'    =>$value->id
                ];
                foreach($request[$value->name] as $key => $value){
                    if($value=='add'){
                        $insertmoduledata['add_access']='1';
                    }
                    if($value=='view'){
                        $insertmoduledata['view_access']='1';
                    }
                    if($value=='modify'){
                        $insertmoduledata['edit_access']='1';
                    }
                    if($value=='delete'){
                        $insertmoduledata['delete_access']='1';
                    }

                    PermissionModule::create($insertmoduledata);
                }

            }
        }

        return redirect()->route('edit-permission',$id)->with('success','Role Updated Successfully');

    }

    /* function to soft delete permission */
    public function destroy(string $id)
    {
        $permission=Permission::findOrFail($id);
        $permission->delete();
        $permission->update(['deleted_by'=>auth()->id(),'is_deleted'=>'1']);
        return redirect()->route('permission-list')->with('success','Permission Soft Deleted Successfully');
    }

    /* function to restore permission */
    public function restore($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->restore();
        $permission->update(['deleted_by'=>null,'is_deleted'=>'0']);
        return redirect()->route('permission-list')->with('success','Permission Restored Successfully');
    }

    /* function to force delete permission */
    public function forceDelete($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->forceDelete();
        return redirect()->route('permission-list')->with('success','Role Permanently Deleted Successfully');
    }

    /* function to update permission status */
    public function updatestatus(Request $request)
    {
        $permission=Permission::findOrFail($request->id);
        if($request->checked=="false"){
            $permission->update(['is_active'=>0]);
        }
        if($request->checked=="true"){
            $permission->update(['is_active'=>1]);
        }
    }
}

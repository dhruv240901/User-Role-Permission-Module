<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Module;
use App\Models\PermissionModule;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions=Permission::withTrashed()->get();
        return view('permission.list',compact('permissions'));
    }

    public function create()
    {
        $modules=Module::all();
        return view('permission.create',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permission=Permission::findOrFail($id);
        $modules=Module::all();
        $permissionmodules=PermissionModule::where('permission_id',$id)->get();
        return view('permission.show',compact('permission','modules','permissionmodules'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $modules=Module::all();
        $permission=Permission::findOrFail($id);
        return view('permission.edit',compact('permission','modules'));
    }

    /**
     * Update the specified resource in storage.
     */
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

        return redirect()->route('edit-permission')->with('success','Role Created Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission=Permission::findOrFail($id);
        $permission->delete();
        $permission->update(['deleted_by'=>auth()->id(),'is_deleted'=>'1']);
        return redirect()->route('permission-list')->with('success','Permission Soft Deleted Successfully');
    }

    public function restore($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->restore();
        $permission->update(['deleted_by'=>null,'is_deleted'=>'0']);
        return redirect()->route('permission-list')->with('success','Permission Restored Successfully');
    }

    public function forceDelete($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->forceDelete();
        return redirect()->route('permission-list')->with('success','Role Permanently Deleted Successfully');
    }

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

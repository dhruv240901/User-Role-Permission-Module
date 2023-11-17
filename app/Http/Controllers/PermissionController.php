<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Module;
use App\Models\PermissionModule;
use DB;
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
        $modules=DB::table('modules as parent')
                ->select('parent.name as parent_name', DB::raw('GROUP_CONCAT(child.name) as child_names'))
                ->leftJoin('modules as child', 'parent.id', '=', 'child.parent_id')
                ->groupBy('parent.id')
                ->get();
        $permission=null;
        return view('permission.create',compact('modules','permission'));
    }

    /* function to store permission in database */
    public function store(Request $request)
    {
        $request->validate([
            'permissionname' =>'required',
            'description'    =>'required',
        ]);

        $insertData=[
            'name'        =>$request->permissionname,
            'description' =>$request->description,
        ];

        $permission=Permission::create($insertData);

        $modules=Module::all();

        $insertModuleData=array();
        foreach($modules as $k=>$value){
            if($request[$value->name]){
                $insertModuleData=[
                    'permission_id'=>$permission->id,
                    'module_id'    =>$value->id
                ];
                foreach($request[$value->name] as $key => $value){
                    if($value=='add'){
                        $insertModuleData['add_access']='1';
                    }
                    if($value=='view'){
                        $insertModuleData['view_access']='1';
                    }
                    if($value=='modify'){
                        $insertModuleData['edit_access']='1';
                    }
                    if($value=='delete'){
                        $insertModuleData['delete_access']='1';
                    }
                }
                PermissionModule::create($insertModuleData);
            }
        }

        return redirect()->route('add-permission')->with('success','Role Created Successfully');
    }

    /* function to show permission details by id */
    public function show(string $id)
    {
        $permission=Permission::findOrFail($id);
        $modules=DB::table('modules as parent')
        ->select('parent.name as parent_name', DB::raw('GROUP_CONCAT(child.name) as child_names'))
        ->leftJoin('modules as child', 'parent.id', '=', 'child.parent_id')
        ->groupBy('parent.id')
        ->get();
        $permissionModules=PermissionModule::where('permission_id',$id)->get();
        return view('permission.show',compact('permission','modules','permissionModules'));
    }

    /* function to render edit permission form */
    public function edit(string $id)
    {
        $modules=DB::table('modules as parent')
        ->select('parent.name as parent_name', DB::raw('GROUP_CONCAT(child.name) as child_names'))
        ->leftJoin('modules as child', 'parent.id', '=', 'child.parent_id')
        ->groupBy('parent.id')
        ->get();
        $permission=Permission::findOrFail($id);
        return view('permission.create',compact('permission','modules'));
    }

    /* function to update permission */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'permissionname' =>'required',
            'description'    =>'required',
        ]);

        $updateData=[
            'name'        =>$request->permissionname,
            'description' =>$request->description,
        ];

        $permission=Permission::findOrFail($id);
        $permission->update($updateData);

        $permissionModules=PermissionModule::where('permission_id',$id)->get();
        foreach($permissionModules as $k=>$permissionModule){
            $permissionModule->delete();

        }

        $modules=Module::all();

        $insertModuleData=array();
        foreach($modules as $k=>$value){
            if($request[$value->name]){
                $insertModuleData=[
                    'permission_id'=>$permission->id,
                    'module_id'    =>$value->id
                ];
                foreach($request[$value->name] as $key => $value){
                    if($value=='add'){
                        $insertModuleData['add_access']='1';
                    }
                    if($value=='view'){
                        $insertModuleData['view_access']='1';
                    }
                    if($value=='modify'){
                        $insertModuleData['edit_access']='1';
                    }
                    if($value=='delete'){
                        $insertModuleData['delete_access']='1';
                    }

                    PermissionModule::create($insertModuleData);
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
        return redirect()->route('permission-list')->with('success','Permission Soft Deleted Successfully');
    }

    /* function to restore permission */
    public function restore($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->restore();
        return redirect()->route('permission-list')->with('success','Permission Restored Successfully');
    }

    /* function to force delete permission */
    public function forceDelete($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->forceDelete();
        return redirect()->route('permission-list')->with('success','Permission Permanently Deleted Successfully');
    }

    /* function to update permission status */
    public function updateStatus(Request $request)
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

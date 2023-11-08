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
            'description' =>$request->description
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
                        $insertmoduledata['modify_access']='1';
                    }
                    if($value=='delete'){
                        $insertmoduledata['delete_access']='1';
                    }
                }
                PermissionModule::create($insertmoduledata);
            }
        }

        return redirect()->route('add-role')->with('success','Role Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission=Permission::findOrFail($id)->delete();
        return redirect()->route('permission-list')->with('success','Permission Soft Deleted Successfully');
    }

    public function restore($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->restore();
        return redirect()->route('permission-list')->with('success','Permission Restored Successfully');
    }

    public function forceDelete($id)
    {
        $role = Permission::onlyTrashed()->findOrFail($id);
        $role->forceDelete();
        return redirect()->route('permission-list')->with('success','Role Permanently Deleted Successfully');
    }
}

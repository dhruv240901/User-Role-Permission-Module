<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    /* function to display modules list */
    public function index()
    {
        $modules=Module::withTrashed()->get();
        return view('module.list',compact('modules'));
    }

    /* function to render add module form */
    public function create()
    {
        $modules=Module::all();
        return view('module.create',compact('modules'));
    }

    /* function to store module in database */
    public function store(Request $request)
    {
        $request->validate([
            'modulecode'    =>'required',
            'modulename'    =>'required',
            'is_in_menu'    =>'required',
        ]);

        $insertdata=[
            'module_code'   =>$request->modulecode,
            'name'          =>$request->modulename,
            'is_in_menu'    =>$request->is_in_menu,
            'display_order' =>$request->display_order,
            'created_by'    =>auth()->id()
        ];

        if($request->parentmodule=="null"){
            $insertdata['parent_id']=null;
        }
        else{
            $insertdata['parent_id']=$request->parentmodule;
        }

        Module::create($insertdata);
        return redirect()->route('add-module')->with('success','Module created successfully');
    }

    /* function to show module details by id */
    public function show(string $id)
    {
        $module=Module::findOrFail($id);
        return view('module.show',compact('module'));
    }

    /* function to render edit module form */
    public function edit(string $id)
    {
        $module=Module::findOrFail($id);
        $modules=Module::all();
        return view('module.edit',compact('module','modules'));
    }

    /* function to update module */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'modulecode'    =>'required',
            'modulename'    =>'required',
            'is_in_menu'    =>'required',
        ]);

        $updatedata=[
            'module_code'   =>$request->modulecode,
            'name'          =>$request->modulename,
            'is_in_menu'    =>$request->is_in_menu,
            'display_order' =>$request->display_order,
            'updated_by'    =>auth()->id()
        ];

        $module=Module::findOrFail($id);
        if($request->parentmodule=="null"){
            $updatedata['parent_id']=null;
        }
        else{
            $updatedata['parent_id']=$request->parentmodule;
        }

        $module->update($updatedata);
        return redirect()->route('edit-module',$id)->with('success','Module updated successfully');
    }

    /* function to soft delete module */
    public function destroy(string $id)
    {
        $module=Module::findOrFail($id);
        $module->delete();
        $module->update(['deleted_by'=>auth()->id(),'is_deleted'=>'1']);
        return redirect()->route('module-list')->with('success','Module Soft Deleted Successfully');
    }

    /* function to restore module */
    public function restore($id)
    {
        $module = Module::onlyTrashed()->findOrFail($id);
        $module->restore();
        $module->update(['deleted_by'=>null,'is_deleted'=>'0']);
        return redirect()->route('module-list')->with('success','Module Restored Successfully');
    }

    /* function to force delete module */
    public function forceDelete($id)
    {
        $module = Module::onlyTrashed()->findOrFail($id);
        $module->forceDelete();
        return redirect()->route('module-list')->with('success','Role Permanently Deleted Successfully');
    }

    /* function to update module status */
    public function updateStatus(Request $request)
    {
        $module=Module::findOrFail($request->id);
        if($request->checked=="false"){
            $module->update(['is_active'=>0]);
        }
        if($request->checked=="true"){
            $module->update(['is_active'=>1]);
        }
    }
}

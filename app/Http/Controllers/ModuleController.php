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
        $modules=Module::whereNull('parent_id')->get();
        $module=null;
        return view('module.addEdit',compact('modules','module'));
    }

    /* function to store module in database */
    public function store(Request $request)
    {
        $request->validate([
            'modulecode'    =>'required',
            'modulename'    =>'required',
            'is_in_menu'    =>'required',
        ]);

        $insertData=[
            'module_code'   =>$request->modulecode,
            'name'          =>$request->modulename,
            'is_in_menu'    =>$request->is_in_menu,
            'display_order' =>$request->display_order,
        ];

        if($request->parentmodule=="null"){
            $insertData['parent_id']=null;
        }
        else{
            $insertData['parent_id']=$request->parentmodule;
        }

        Module::create($insertData);
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
        $modules=Module::whereNull('parent_id')->get();
        return view('module.addEdit',compact('module','modules'));
    }

    /* function to update module */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'modulecode'    =>'required',
            'modulename'    =>'required',
            'is_in_menu'    =>'required',
        ]);

        $updateData=[
            'module_code'   =>$request->modulecode,
            'name'          =>$request->modulename,
            'is_in_menu'    =>$request->is_in_menu,
            'display_order' =>$request->display_order,
        ];

        $module=Module::findOrFail($id);
        if($request->parentmodule=="null"){
            $updatedata['parent_id']=null;
        }
        else{
            $updatedata['parent_id']=$request->parentmodule;
        }

        $module->update($updateData);
        return redirect()->route('edit-module',$id)->with('success','Module updated successfully');
    }

    /* function to soft delete module */
    public function destroy(string $id)
    {
        $module=Module::findOrFail($id);
        $module->delete();
        return redirect()->route('module-list')->with('success','Module Soft Deleted Successfully');
    }

    /* function to restore module */
    public function restore($id)
    {
        $module = Module::onlyTrashed()->findOrFail($id);
        $module->restore();
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
            $message="Module Inactivated Successfully";
        }
        if($request->checked=="true"){
            $module->update(['is_active'=>1]);
            $message="Module Activated Successfully";
        }
        return $message;
    }
}

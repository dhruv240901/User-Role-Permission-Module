<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules=Module::withTrashed()->get();
        return view('module.list',compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules=Module::all();
        return view('module.create',compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $module=Module::findOrFail($id);
        return view('module.show',compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $module=Module::findOrFail($id);
        $modules=Module::all();
        return view('module.edit',compact('module','modules'));
    }

    /**
     * Update the specified resource in storage.
     */
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
            'created_by'    =>auth()->id()
        ];

        $module=Module::findOrFail($id);
        if($request->parentmodule=="null"){
            $updatedata['parent_id']=null;
        }
        else{
            $updatedata['parent_id']=$request->parentmodule;
        }

        $module->update($updatedata);
        return redirect()->route('edit-module')->with('success','Module updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $module=Module::findOrFail($id)->delete();
        return redirect()->route('module-list')->with('success','Module Soft Deleted Successfully');
    }

    public function restore($id)
    {
        $module = Module::onlyTrashed()->findOrFail($id);
        $module->restore();
        return redirect()->route('module-list')->with('success','Module Restored Successfully');
    }

    public function forceDelete($id)
    {
        $module = Module::onlyTrashed()->findOrFail($id);
        $module->forceDelete();
        return redirect()->route('module-list')->with('success','Role Permanently Deleted Successfully');
    }

    public function updatestatus(Request $request)
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

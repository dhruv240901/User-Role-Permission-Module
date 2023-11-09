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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}

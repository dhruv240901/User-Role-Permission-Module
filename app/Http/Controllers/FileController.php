<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Traits\ModulesDisplay;

class FileController extends Controller
{
    use ModulesDisplay;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files=File::withTrashed()->get();
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('file.list',compact('files','modules','parentModules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $file=null;
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('file.addEdit',compact('file','modules','parentModules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'required'
        ]);

        File::create($request->only('name','description'));
        return redirect()->route('file-list')->with('success','File Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $file=File::findOrFail($id);
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('file.show',compact('file','modules','parentModules'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $file=File::findOrFail($id);
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('file.addEdit',compact('file','modules','parentModules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'        => 'required',
            'description' => 'required'
        ]);

        $file=File::findOrFail($id);
        $file->update($request->only('name','description'));
        return redirect()->route('edit-file')->with('succes','File Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $file = File::findOrFail($id);
        $file->delete();
        return redirect()->route('file-list')->with('success', 'File Soft Deleted Successfully');
    }

    /* function to restore permission */
    public function restore($id)
    {
        $file = File::onlyTrashed()->findOrFail($id);
        $file->restore();
        return redirect()->route('file-list')->with('success', 'File Restored Successfully');
    }

    /* function to force delete permission */
    public function forceDelete($id)
    {
        $file = File::onlyTrashed()->findOrFail($id);
        $file->forceDelete();
        return redirect()->route('file-list')->with('success', 'File Permanently Deleted Successfully');
    }

}

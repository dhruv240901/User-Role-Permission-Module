<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Traits\ModulesDisplay;

class FileController extends Controller
{
    use ModulesDisplay;

    /* function to display file list */
    public function index()
    {
        $files=File::withTrashed()->get();
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('file.list',compact('files','modules','parentModules'));
    }

    /* function to render add file Form */
    public function create()
    {
        $file=null;
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('file.addEdit',compact('file','modules','parentModules'));
    }

     /* function to store file in database */
    public function store(Request $request)
    {
        // Validate Add File Form Request
        $request->validate([
            'name'        => 'required',
            'description' => 'required'
        ]);

        // Store Add File Form Details into the database
        File::create($request->only('name','description'));
        return redirect()->route('file-list')->with('success','File Created Successfully');
    }

    /* function to show file details by id */
    public function show($id)
    {
        $file=File::findOrFail($id);
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('file.show',compact('file','modules','parentModules'));
    }

    /* function to render edit file form */
    public function edit(string $id)
    {
        $file=File::findOrFail($id);
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('file.addEdit',compact('file','modules','parentModules'));
    }

    /* function to update file */
    public function update(Request $request, string $id)
    {
         // Validate Edit File Form Request
        $request->validate([
            'name'        => 'required',
            'description' => 'required'
        ]);

        // Update File Details in the Database 
        $file=File::findOrFail($id);
        $file->update($request->only('name','description'));
        return redirect()->route('edit-file',$id)->with('succes','File Updated Successfully');
    }

    /* function to soft delete file */
    public function destroy(string $id)
    {
        $file = File::findOrFail($id);
        $file->delete();
        return redirect()->route('file-list')->with('success', 'File Soft Deleted Successfully');
    }

    /* function to restore file */
    public function restore($id)
    {
        $file = File::onlyTrashed()->findOrFail($id);
        $file->restore();
        return redirect()->route('file-list')->with('success', 'File Restored Successfully');
    }

    /* function to force delete file */
    public function forceDelete($id)
    {
        $file = File::onlyTrashed()->findOrFail($id);
        $file->forceDelete();
        return redirect()->route('file-list')->with('success', 'File Permanently Deleted Successfully');
    }

}

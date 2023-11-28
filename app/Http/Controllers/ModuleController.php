<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Traits\AjaxResponse;
use App\Traits\ModulesDisplay;

class ModuleController extends Controller
{
    use AjaxResponse,ModulesDisplay;
    
    /* function to display modules list */
    public function index()
    {
        $Modules = Module::withTrashed()->get();
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('module.list', compact('Modules','modules','parentModules'));
    }

    /* function to render add module form */
    public function create()
    {
        $Modules = Module::whereNull('parent_id')->get();
        $module = null;
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('module.addEdit', compact('Modules', 'module','modules','parentModules'));
    }

    /* function to store module in database */
    public function store(Request $request)
    {
        $request->validate([
            'moduleCode'    => 'required|string|unique:modules,module_code',
            'moduleName'    => 'required|string',
            'is_in_menu'    => 'required|boolean',
            'display_order' => 'required'
        ]);

        $insertData = [
            'module_code'   => $request->moduleCode,
            'name'          => $request->moduleName,
            'is_in_menu'    => $request->is_in_menu,
            'display_order' => $request->display_order,
        ];

        if ($request->parentModule == "null") {
            $insertData['parent_id'] = null;
        } else {
            $insertData['parent_id'] = $request->parentModule;
        }

        Module::create($insertData);
        return redirect()->route('add-module')->with('success', 'Module created successfully');
    }

    /* function to show module details by id */
    public function show(string $id)
    {
        $Module = Module::findOrFail($id);
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('module.show', compact('Module','modules','parentModules'));
    }

    /* function to render edit module form */
    public function edit(string $id)
    {
        $module = Module::findOrFail($id);
        $Modules = Module::whereNull('parent_id')->get();
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('module.addEdit', compact('module', 'Modules','modules','parentModules'));
    }

    /* function to update module */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'moduleCode'    => 'required|string|unique:modules,module_code',
            'moduleName'    => 'required|string',
            'display_order' => 'required',
        ]);

        $updateData = [
            'module_code'   => $request->moduleCode,
            'name'          => $request->moduleName,
            'display_order' => $request->display_order,
        ];

        $module = Module::findOrFail($id);
        if ($request->parentModule == "null") {
            $updateData['parent_id'] = null;
        } else {
            $updateData['parent_id'] = $request->parentModule;
        }

        $module->update($updateData);
        return redirect()->route('edit-module', $id)->with('success', 'Module updated successfully');
    }

    /* function to soft delete module */
    public function destroy(string $id)
    {
        $module = Module::findOrFail($id);
        $module->delete();
        $module = Module::where('parent_id',$id)->delete();
        return redirect()->route('module-list')->with('success', 'Module Soft Deleted Successfully');
    }

    /* function to restore module */
    public function restore($id)
    {
        $module = Module::onlyTrashed()->findOrFail($id);
        $module->restore();
        return redirect()->route('module-list')->with('success', 'Module Restored Successfully');
    }

    /* function to force delete module */
    public function forceDelete($id)
    {
        $module = Module::onlyTrashed()->findOrFail($id);
        $module->forceDelete();
        return redirect()->route('module-list')->with('success', 'Role Permanently Deleted Successfully');
    }

    /* function to update module status */
    public function updateStatus(Request $request)
    {
        $module = Module::findOrFail($request->id);
        if ($request->checked == "false") {
            $module->update(['is_active' => false]);
            $message = "Module Inactivated Successfully";
        }
        if ($request->checked == "true") {
            $module->update(['is_active' => true]);
            $message = "Module Activated Successfully";
        }
        $response=$this->success(200,$message);
        return $response;
    }
}

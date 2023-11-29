<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Module;
use App\Models\PermissionModule;
use App\Traits\AjaxResponse;
use App\Traits\ModulesDisplay;

class PermissionController extends Controller
{
    use AjaxResponse,ModulesDisplay;

    /* function to display permissions list */
    public function index()
    {
        $permissions = Permission::withTrashed()->get();
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('permission.list', compact('permissions','modules', 'parentModules'));
    }

    /* function to render add permission form */
    public function create()
    {
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        $permission = null;
        $permissionModules = null;
        return view('permission.addEdit', compact('permission', 'modules', 'parentModules', 'permissionModules'));
    }

    /* function to store permission in database */
    public function store(Request $request)
    {
        // Validate Add Permission Form Request
        $request->validate([
            'permissionName' => 'required|string',
            'description'    => 'required|string',
        ]);

        // Store Add Permission Form Details into the database
        $insertData = [
            'name'        => $request->permissionName,
            'description' => $request->description,
        ];

        $permission = Permission::create($insertData);

        // Store Add Permission Form Modules and there access into the database
        $modules = Module::all();
        $insertModuleData = array();
        foreach ($modules as $k => $value) {
            if ($request[$value->name]) {
                $insertModuleData = [
                    'permission_id' => $permission->id,
                    'module_id'    => $value->id
                ];
                foreach ($request[$value->name] as $key => $value) {
                    if ($value == 'add') {
                        $insertModuleData['add_access'] = true;
                    }
                    if ($value == 'view') {
                        $insertModuleData['view_access'] = true;
                    }
                    if ($value == 'modify') {
                        $insertModuleData['edit_access'] = true;
                    }
                    if ($value == 'delete') {
                        $insertModuleData['delete_access'] = true;
                    }
                }
                PermissionModule::create($insertModuleData);
            }
        }

        return redirect()->route('add-permission')->with('success', 'Permission Created Successfully');
    }

    /* function to show permission details by id */
    public function show(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permissionModules = $permission->modules->pluck('pivot')->toArray();
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('permission.show', compact('permission', 'modules', 'parentModules', 'permissionModules'));
    }

    /* function to render edit permission form */
    public function edit(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permissionModules = $permission->modules->pluck('pivot')->toArray();
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('permission.addEdit', compact('permission', 'modules', 'parentModules', 'permissionModules'));
    }

    /* function to update permission */
    public function update(Request $request, string $id)
    {
        // Validate Update Permission Form
        $request->validate([
            'permissionName' => 'required|string',
            'description'    => 'required|string',
        ]);

        // Update Permission in the database
        $updateData = [
            'name'        => $request->permissionName,
            'description' => $request->description,
        ];

        $permission = Permission::findOrFail($id);
        $permission->update($updateData);

        // Delete old modules of the permission from the database
        $permissionModules = PermissionModule::where('permission_id', $id)->get();
        foreach ($permissionModules as $k => $permissionModule) {
            $permissionModule->delete();
        }

        // Store Edit Permission Form Modules and there access into the database
        $modules = Module::all();
        $insertModuleData = array();
        foreach ($modules as $k => $value) {
            if ($request[$value->name]) {
                $insertModuleData = [
                    'permission_id' => $permission->id,
                    'module_id'    => $value->id
                ];
                foreach ($request[$value->name] as $key => $value) {
                    if ($value == 'add') {
                        $insertModuleData['add_access'] = true;
                    }
                    if ($value == 'view') {
                        $insertModuleData['view_access'] = true;
                    }
                    if ($value == 'modify') {
                        $insertModuleData['edit_access'] = true;
                    }
                    if ($value == 'delete') {
                        $insertModuleData['delete_access'] = true;
                    }
                }
                PermissionModule::create($insertModuleData);
            }
        }

        return redirect()->route('edit-permission', $id)->with('success', 'Permission Updated Successfully');
    }

    /* function to soft delete permission */
    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('permission-list')->with('success', 'Permission Soft Deleted Successfully');
    }

    /* function to restore permission */
    public function restore($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->restore();
        return redirect()->route('permission-list')->with('success', 'Permission Restored Successfully');
    }

    /* function to force delete permission */
    public function forceDelete($id)
    {
        $permission = Permission::onlyTrashed()->findOrFail($id);
        $permission->forceDelete();
        return redirect()->route('permission-list')->with('success', 'Permission Permanently Deleted Successfully');
    }

    /* function to update permission status */
    public function updateStatus(Request $request)
    {
        // Validate update permission status request
        $request->validate([
            'checked' => 'required'
        ]);

        $permission = Permission::findOrFail($request->id);

        // Inactivate Permission if Permission is Activated
        if ($request->checked == "false") {
            $permission->update(['is_active' => false]);
            $message = "Permission Inactivated Successfully";
        }

        // Activate Permission if Permission is Inactivated
        if ($request->checked == "true") {
            $permission->update(['is_active' => true]);
            $message = "Permission Activated Successfully";
        }
        $response=$this->success(200,$message);
        return $response;
    }
}

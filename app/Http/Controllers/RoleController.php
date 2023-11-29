<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Traits\AjaxResponse;
use App\Traits\ModulesDisplay;

class RoleController extends Controller
{
    use AjaxResponse,ModulesDisplay;

    /* function to display roles list */
    public function index()
    {
        $roles = Role::withTrashed()->get();
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('role.list', compact('roles','modules','parentModules'));
    }

    /* function to render add role form */
    public function create()
    {
        $permissions = Permission::where('is_active', true)->get();
        $role = null;
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('role.addEdit', compact('permissions', 'role','modules','parentModules'));
    }

    /* function to store role in database */
    public function store(Request $request)
    {
        // Validate Add Role Form Request
        $request->validate([
            'roleName'    => 'required|string',
            'description' => 'required|string',
            'permissions' => 'required|exists:permissions,id'
        ]);

        // Store Add Role Form Details in the database
        $insertData = [
            'name'        => $request->roleName,
            'description' => $request->description,
        ];

        $role = Role::create($insertData);

        // Store Requested permissions into the database
        if ($request->permissions) {
            foreach ($request->permissions as $key => $permissionId) {
                $role->permissions()->attach($request->permissions[$key]);
            }
        }

        return redirect()->route('add-role')->with('success', 'Role Created Successfully');
    }

    /* function to show role details by id */
    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('role.show', compact('role','modules','parentModules'));
    }

    /* function to render edit role form */
    public function edit(string $id)
    {
        $permissions = Permission::where('is_active', true)->get();
        $role = Role::findOrFail($id);
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('role.addEdit', compact('role', 'permissions','modules','parentModules'));
    }

    /* function to update role */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        // Validate Edit Role Form Request
        $request->validate([
            'roleName'    => 'required|string',
            'description' => 'required|string',
            'permissions' => 'required|exists:permissions,id'
        ]);

        // Update Edit Role Form Request into the database
        $updateData = [
            'name'        => $request->roleName,
            'description' => $request->description,
        ];

        $role->update($updateData);

        if ($request->permissions) {

            // Delete Old Permissions from the database
            foreach ($role->permissions as $key => $permissionId) {
                $role->permissions()->detach($role->permissions[$key]);
            }

            // Add New Permissions into the database
            foreach ($request->permissions as $key => $permissionId) {
                $role->permissions()->attach($request->permissions[$key]);
            }
        }
        return redirect()->route('edit-role', $id)->with('success', 'Role Updated Successfully');
    }

    /* function to soft delete role */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('role-list')->with('success', 'Role Soft Deleted Successfully');
    }

    /* function to restore role */
    public function restore($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->restore();
        return redirect()->route('role-list')->with('success', 'Role Restored Successfully');
    }

    /* function to force delete role */
    public function forceDelete($id)
    {
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->forceDelete();
        return redirect()->route('role-list')->with('success', 'Role Permanently Deleted Successfully');
    }

    /* function to update role status */
    public function updateStatus(Request $request)
    {
        // Validate update role status request
        $request->validate([
            'checked' => 'required'
        ]);
        $role = Role::findOrFail($request->id);

        // Inactivate Role if Role is Activated
        if ($request->checked == "false") {
            $role->update(['is_active' => false]);
            $message = "Role Inactivated Successfully";
        }

        // Activate Role if Role is Inactivated
        if ($request->checked == "true") {
            $role->update(['is_active' => true]);
            $message = "Role Activated Successfully";
        }
        $response=$this->success(200,$message);
        return $response;
    }
}

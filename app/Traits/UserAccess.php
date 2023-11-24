<?php

namespace app\Traits;

use App\Models\Module;

trait UserAccess
{
    public function UserAccess($module, $action)
    {
        if (auth()->user()->type == 'admin') {
            return true;
        } else {
            if (auth()->user()->hasModule($module)) {
                $moduleData = Module::where('name', $module)->first();
                $pivotData = auth()->user()->roles->flatMap->permissions->flatMap->modules->pluck('pivot')->toArray();
                foreach ($pivotData as $item) {
                    if ($item["module_id"] === $moduleData->id) {
                        if ($item['add_access'] == 1 && $action == 'add') {
                            return true;
                        }
                        if ($item['view_access'] == 1 && $action == 'view') {
                            return true;
                        }
                        if ($item['edit_access'] == 1 && $action == 'edit') {
                            return true;
                        }
                        if ($item['delete_access'] == 1 && $action == 'delete') {
                            return true;
                        }
                        if ($item['edit_access'] == 1 && $action == 'status') {
                            return true;
                        }
                    }
                }
            } else {
                return false;
            }
        }
    }
}

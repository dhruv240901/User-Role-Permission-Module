<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'is_active', 'created_by', 'updated_by', 'deleted_by', 'is_deleted'];

    protected $casts = [
        'is_active'         => 'boolean',
        'is_deleted'        => 'boolean'
    ];

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'permission_module')->withPivot('add_access', 'edit_access', 'delete_access', 'view_access');
    }

    public function hasPermission($module, $action)
    {
        $moduleData = $this->modules->where('module_code', $module)->first();
        if ($moduleData) {
            foreach ($this->modules as $value) {
                if ($action != 'any') {
                    if ($value->pivot[$action.'_access'] && $value->module_code == $module) {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        } else {
            return false;
        }
    }
}

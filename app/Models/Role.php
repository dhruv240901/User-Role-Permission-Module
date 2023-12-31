<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'is_active', 'created_by', 'updated_by', 'deleted_by', 'is_deleted'];

    protected $casts = [
        'is_active'  => 'boolean',
        'is_deleted' => 'boolean'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    public function hasRole($module, $action)
    {
        foreach ($this->permissions as $permission) {
           if($permission->hasPermission($module, $action)){
                return true;
           }
        }
        return false;
    }
}

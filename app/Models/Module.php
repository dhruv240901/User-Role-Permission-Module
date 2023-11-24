<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'module_code', 'is_in_menu', 'parent_id', 'is_active', 'display_order', 'created_by', 'updated_by', 'deleted_by', 'is_deleted'];

    protected $casts = [
        'is_active'  => 'boolean',
        'is_deleted' => 'boolean'
    ];

    public function children()
    {
        return $this->hasMany(Module::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Module::class, 'parent_id');
    }
}

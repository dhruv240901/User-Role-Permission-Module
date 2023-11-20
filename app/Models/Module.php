<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['name','module_code','name','is_in_menu','parent_id','is_active','display_order','created_by','updated_by','deleted_by','is_deleted'];

    protected $casts = [
        'is_active'         => 'boolean',
        'is_deleted'        => 'boolean'
    ];

    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
            $model->created_by=auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });

        static::deleting(function ($model) {
            $model->is_deleted = 1;
            $model->deleted_by=auth()->id();
            $model->save();
        });

        static::restoring(function ($model) {
            $model->is_deleted = 0;
            $model->deleted_by=null;
        });
    }

    public function children()
    {
        return $this->hasMany(Module::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Module::class, 'parent_id');
    }
}

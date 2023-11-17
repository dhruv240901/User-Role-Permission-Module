<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['name','description','is_active','created_by','updated_by','deleted_by','is_deleted'];

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

    public function modules()
    {
        return $this->belongsToMany(Module::class,'permission_module');
    }

}

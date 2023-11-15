<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['name','module_code','name','is_in_menu','parent_id','is_active','created_by','updated_by','deleted_by','is_deleted'];

    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function parent()
    {
        return $this->belongsTo(Module::class,'parent_id');
    }
}

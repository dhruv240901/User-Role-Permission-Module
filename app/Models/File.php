<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['name','description','is_deleted'];

    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });

        // static::updating(function ($model) {
        // });

        static::deleting(function ($model) {
            $model->is_deleted = 1;
            $model->save();
        });

        static::restoring(function ($model) {
            $model->is_deleted = 0;
        });
    }

}

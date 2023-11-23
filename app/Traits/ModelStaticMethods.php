<?php

namespace app\Traits;
use Illuminate\Support\Str;

trait ModelStaticMethods
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
            $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });

        static::deleting(function ($model) {
            $model->is_deleted = 1;
            $model->deleted_by = auth()->id();
            $model->save();
        });

        static::restoring(function ($model) {
            $model->is_deleted = 0;
            $model->deleted_by = null;
        });
    }
}

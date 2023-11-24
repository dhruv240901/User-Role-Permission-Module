<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UserAccess;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, UserAccess;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'is_first_login',
        'is_active',
        'type',
        'created_by',
        'updated_by',
        'deleted_by',
        'is_deleted'
    ];

    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function hasModule($module)
    {
        return $this->roles->flatMap->permissions->flatMap->modules->pluck('module_code')->contains($module);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_first_login'    => 'boolean',
        'is_active'         => 'boolean',
        'is_deleted'        => 'boolean'
    ];
}

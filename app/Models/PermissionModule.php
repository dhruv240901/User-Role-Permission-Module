<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionModule extends Model
{
    use HasFactory;

    protected $table='permission_module';

    protected $fillable=['permission_id','module_id','add_access','edit_access','delete_access',''];
}

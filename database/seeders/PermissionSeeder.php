<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['id'=>Str::uuid(),'name'=>'User CRUD permission','description'=>'Can access only user crud permission'],
            ['id'=>Str::uuid(),'name'=>'User, Role, Permission Read permission','description'=>'Can only read User, Role, Permission details'],
            ['id'=>Str::uuid(),'name'=>'User Read permission','description'=>'Can access only show users list'],
       ];

       Permission::insert($permissions);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['id'=>'2ff70aa9-4515-45df-98a9-4483fd95e8d4','name'=>'User CRUD permission','description'=>'Can access only user crud permission'],
            ['id'=>'453a58ff-804e-40a4-b0cb-5c72f92374c7','name'=>'User, Role, Permission Read permission','description'=>'Can only read User, Role, Permission details'],
            ['id'=>'b4f00eb6-df4c-4793-adf0-f89b29adc8fc','name'=>'User Read permission','description'=>'Can access only show users list'],
       ];

       Permission::insert($permissions);
    }
}

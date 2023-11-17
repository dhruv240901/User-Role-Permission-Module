<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id'=>Str::uuid(),'name'=>'Account Owner-Role','description'=>'Can access all permission'],
            ['id'=>Str::uuid(),'name'=>'User Owner-Role','description'=>'Can access only user related permission'],
            ['id'=>Str::uuid(),'name'=>'Guest-Role','description'=>'Can access only show users list'],
       ];

       Role::insert($roles);
    }
}

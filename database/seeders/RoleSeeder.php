<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id'=>'7bbd4a96-5fa8-4cb3-b4dd-c14dfe47987f','name'=>'Account Owner-Role','description'=>'Can access all permission'],
            ['id'=>'72e510a0-1972-420e-b1b5-c48f5cd707d2','name'=>'User Owner-Role','description'=>'Can access only user related permission'],
            ['id'=>'08b441a8-9716-4e7a-8be6-aff8af5674ce','name'=>'Guest-Role','description'=>'Can access only show users list'],
       ];

       Role::insert($roles);
    }
}

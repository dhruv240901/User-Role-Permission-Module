<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['id'=>Str::uuid(),'module_code'=>'Acc','name'=>'Account','parent_id'=>null],
            ['id'=>Str::uuid(),'module_code'=>'AL','name'=>'Activity Log','parent_id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9'],
            ['id'=>Str::uuid(),'module_code'=>'FL','name'=>'File','parent_id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9'],
            ['id'=>Str::uuid(),'module_code'=>'PER','name'=>'Permission','parent_id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9'],
            ['id'=>Str::uuid(),'module_code'=>'RO','name'=>'Role','parent_id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9'],
            ['id'=>Str::uuid(),'module_code'=>'US','name'=>'User','parent_id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9'],
       ];

       Module::insert($modules);
    }
}

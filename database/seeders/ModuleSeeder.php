<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9','module_code'=>'Acc','name'=>'Account','parent_id'=>null],
            ['id'=>'c1041e66-ed16-499c-ba6a-a04e514f7475','module_code'=>'AL','name'=>'Activity Log','parent_id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9'],
            ['id'=>'f1f9c6b1-b0da-409a-8c78-ba35e7800d6b','module_code'=>'FL','name'=>'File','parent_id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9'],
            ['id'=>'9a25308d-6a16-4312-bc6f-0616c6d75159','module_code'=>'PER','name'=>'Permission','parent_id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9'],
            ['id'=>'1516e033-b202-4feb-9644-93c9d2163645','module_code'=>'RO','name'=>'Role','parent_id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9'],
            ['id'=>'4292ce5a-a33f-4945-aa27-d29262faa54c','module_code'=>'US','name'=>'User','parent_id'=>'8eef54cf-349a-4614-84a4-1bca89b8afd9'],
       ];

       Module::insert($modules);
    }
}

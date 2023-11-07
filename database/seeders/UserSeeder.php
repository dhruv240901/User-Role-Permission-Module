<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            ['id'=>'c9dd5497-0546-4d3a-95d9-f027d217e23d',
            'first_name' => 'Dhruv',
            'last_name'=> 'Patel',
            'email'=>'dhruv@gmail.com',
            'password'=> Hash::make('123456'),
            'is_first_login'=>'0',
            'type'=>'admin',
            ],
       ];

       User::insert($user);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            ['id'            =>Str::uuid(),
            'first_name'     => 'Admin',
            'last_name'      => 'User',
            'email'          =>'admin@gmail.com',
            'password'       => Hash::make('123456'),
            'is_first_login' =>'0',
            'type'           =>'admin',
            ],
       ];

       User::insert($user);
    }
}

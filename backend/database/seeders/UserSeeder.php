<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        //create data user
        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('test123'),
            'role'      => 'admin',
        ]);

        User::create([
            'name'      => 'Branch Office',
            'email'     => 'branch@gmail.com',
            'password'  => bcrypt('test123'),
            'role'      => 'pic_branch_office',
        ]);

        User::create([
            'name'      => 'Head Office',
            'email'     => 'head@gmail.com',
            'password'  => bcrypt('test123'),
            'role'      => 'pic_head_office',
        ]);
    }
}

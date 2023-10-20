<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'name'      => 'PT Test Company',
            'address'   => 'Jl. Test',
            'phone'     => '123456789011',
            'email'     => 'testcompany@gmail.com',
        ]);
    }
}

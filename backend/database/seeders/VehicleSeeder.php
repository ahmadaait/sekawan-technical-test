<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'name'      => 'Truk Cargo',
            'company_id'   => 1,
            'license_plate'     => 'N9899PO',
            'status'     => 'available',
            'ownership_type'     => 'rented_from_another',
            'load_type'     => 'item',
            'fuel_tank'     => 500,
            'service_schedule'     => "2024-10-18",
        ]);
    }
}

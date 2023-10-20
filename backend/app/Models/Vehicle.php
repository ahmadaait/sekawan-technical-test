<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "company_id",
        "license_plate",
        "status",
        "ownership_type",
        "load_type",
        "fuel_tank",
        "service_schedule",
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

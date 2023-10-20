<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('company')->when(request()->search, function ($vehicles) {
            $vehicles = $vehicles->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        $vehicles->appends(['search' => request()->search]);

        return new VehicleResource(true, 'List Data Vehicles', $vehicles);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'license_plate'  => 'required',
            "status"    => 'required',
            "ownership_type"    => 'required',
            "load_type"    => 'required',
            "fuel_tank"    => 'required',
            "service_schedule"    => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $vehicle = Vehicle::create([
            'name'      => $request->name,
            'company_id'  => $request->company_id,
            'license_plate'  => $request->license_plate,
            'status'    => $request->status,
            'ownership_type'    => $request->ownership_type,
            'load_type'    => $request->load_type,
            'fuel_tank'    => $request->fuel_tank,
            'service_schedule'    => $request->service_schedule,
        ]);

        if ($vehicle) {
            return new VehicleResource(true, 'Data Vehicle Berhasil Disimpan!', $vehicle);
        }

        return new VehicleResource(false, 'Data Vehicle Gagal Disimpan!', null);
    }

    public function show($id)
    {
        $vehicle = Vehicle::with('company')->whereId($id)->first();

        if ($vehicle) {
            return new VehicleResource(true, 'Detail Data Vehicle!', $vehicle);
        }

        return new VehicleResource(false, 'Detail Data Vehicle Tidak DItemukan!', null);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'license_plate'  => 'required',
            "status"    => 'required',
            "ownership_type"    => 'required',
            "load_type"    => 'required',
            "fuel_tank"    => 'required',
            "service_schedule"    => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $vehicle->update([
            'name'      => $request->name,
            'company_id'      => $request->company_id,
            'license_plate'  => $request->license_plate,
            'status'  => $request->status,
            'ownership_type'  => $request->ownership_type,
            'load_type'  => $request->load_type,
            'fuel_tank'  => $request->fuel_tank,
            'service_schedule'    => $request->service_schedule
        ]);

        if ($vehicle) {
            return new VehicleResource(true, 'Data Vehicle Berhasil Diupdate!', $vehicle);
        }

        return new VehicleResource(false, 'Data Vehicle Gagal Diupdate!', null);
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->delete()) {
            return new VehicleResource(true, 'Data Vehicle Berhasil Dihapus!', null);
        }

        return new VehicleResource(false, 'Data Vehicle Gagal Dihapus!', null);
    }
}

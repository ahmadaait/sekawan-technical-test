<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::when(request()->search, function ($drivers) {
            $drivers = $drivers->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        $drivers->appends(['search' => request()->search]);

        return new DriverResource(true, 'List Data Drivers', $drivers);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            "status"   => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $driver = Driver::create([
            'name'      => $request->name,
            'status'     => $request->status
        ]);

        if ($driver) {
            return new DriverResource(true, 'Data Driver Berhasil Disimpan!', $driver);
        }

        return new DriverResource(false, 'Data Driver Gagal Disimpan!', null);
    }

    public function show($id)
    {
        $driver = Driver::whereId($id)->first();

        if ($driver) {
            return new DriverResource(true, 'Detail Data Driver!', $driver);
        }

        return new DriverResource(false, 'Detail Data Driver Tidak DItemukan!', null);
    }

    public function update(Request $request, Driver $driver)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $driver->update([
            'name'      => $request->name,
            'status'     => $request->status,
        ]);

        if ($driver) {
            return new DriverResource(true, 'Data Driver Berhasil Diupdate!', $driver);
        }

        return new DriverResource(false, 'Data Driver Gagal Diupdate!', null);
    }

    public function destroy(Driver $driver)
    {
        if ($driver->delete()) {
            return new DriverResource(true, 'Data Driver Berhasil Dihapus!', null);
        }

        return new DriverResource(false, 'Data Driver Gagal Dihapus!', null);
    }
}

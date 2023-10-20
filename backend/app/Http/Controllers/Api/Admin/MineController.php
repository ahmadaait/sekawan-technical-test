<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\MineResource;
use App\Models\Mine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MineController extends Controller
{
    public function index()
    {
        $mines = Mine::when(request()->search, function ($mines) {
            $mines = $mines->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        $mines->appends(['search' => request()->search]);

        return new MineResource(true, 'List Data Mines', $mines);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'location'  => 'required',
            "status"    => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mine = Mine::create([
            'name'      => $request->name,
            'location'  => $request->location,
            'status'    => $request->status
        ]);

        if ($mine) {
            return new MineResource(true, 'Data Mine Berhasil Disimpan!', $mine);
        }

        return new MineResource(false, 'Data Mine Gagal Disimpan!', null);
    }

    public function show($id)
    {
        $mine = Mine::whereId($id)->first();

        if ($mine) {
            return new MineResource(true, 'Detail Data Mine!', $mine);
        }

        return new MineResource(false, 'Detail Data Mine Tidak DItemukan!', null);
    }

    public function update(Request $request, Mine $mine)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'location'  => 'required',
            "status"    => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $mine->update([
            'name'      => $request->name,
            'location'  => $request->location,
            'status'    => $request->status
        ]);

        if ($mine) {
            return new MineResource(true, 'Data Mine Berhasil Diupdate!', $mine);
        }

        return new MineResource(false, 'Data Mine Gagal Diupdate!', null);
    }

    public function destroy(Mine $mine)
    {
        if ($mine->delete()) {
            return new MineResource(true, 'Data Mine Berhasil Dihapus!', null);
        }

        return new MineResource(false, 'Data Mine Gagal Dihapus!', null);
    }
}

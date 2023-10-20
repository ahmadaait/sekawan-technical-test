<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::when(request()->search, function ($users) {
            $users = $users->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        $users->appends(['search' => request()->search]);

        return new UserResource(true, 'List Data Users', $users);
    }

    public function getBranchUserList(){
        $users = User::where('role', 'pic_branch_office')->latest()->paginate(10);
        return new UserResource(true, 'List Data Users', $users); 
    }

    public function getHeadUserList(){
        $users = User::where('role', 'pic_head_office')->latest()->paginate(10);
        return new UserResource(true, 'List Data Users', $users); 
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|unique:users',
            'password' => 'required|confirmed',
            'role'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role'      => $request->role
        ]);

        if ($user) {
            return new UserResource(true, 'Data User Berhasil Disimpan!', $user);
        }

        return new UserResource(false, 'Data User Gagal Disimpan!', null);
    }

    public function show($id)
    {
        $user = User::whereId($id)->first();

        if ($user) {
            return new UserResource(true, 'Detail Data User!', $user);
        }

        return new UserResource(false, 'Detail Data User Tidak DItemukan!', null);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|unique:users,email,' . $user->id,
            'password' => 'confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->password == "") {
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'role'     => $request->role,
            ]);
        } else {
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'role'     => $request->role,
            ]);
        }

        if ($user) {
            return new UserResource(true, 'Data User Berhasil Diupdate!', $user);
        }

        return new UserResource(false, 'Data User Gagal Diupdate!', null);
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            return new UserResource(true, 'Data User Berhasil Dihapus!', null);
        }

        return new UserResource(false, 'Data User Gagal Dihapus!', null);
    }
}
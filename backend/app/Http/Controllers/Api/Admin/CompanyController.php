<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::when(request()->search, function ($companies) {
            $companies = $companies->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);

        $companies->appends(['search' => request()->search]);

        return new CompanyResource(true, 'List Data Companys', $companies);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            "address"   => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $company = Company::create([
            'name'      => $request->name,
            'address'      => $request->address,
            'phone'      => $request->phone,
            'email'     => $request->email
        ]);

        if ($company) {
            return new CompanyResource(true, 'Data Company Berhasil Disimpan!', $company);
        }

        return new CompanyResource(false, 'Data Company Gagal Disimpan!', null);
    }

    public function show($id)
    {
        $company = Company::whereId($id)->first();

        if ($company) {
            return new CompanyResource(true, 'Detail Data Company!', $company);
        }

        return new CompanyResource(false, 'Detail Data Company Tidak DItemukan!', null);
    }

    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'address'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $company->update([
            'name'      => $request->name,
            'address'      => $request->address,
            'phone'      => $request->phone,
            'email'     => $request->email,
        ]);

        if ($company) {
            return new CompanyResource(true, 'Data Company Berhasil Diupdate!', $company);
        }

        return new CompanyResource(false, 'Data Company Gagal Diupdate!', null);
    }

    public function destroy(Company $company)
    {
        if ($company->delete()) {
            return new CompanyResource(true, 'Data Company Berhasil Dihapus!', null);
        }

        return new CompanyResource(false, 'Data Company Gagal Dihapus!', null);
    }
}

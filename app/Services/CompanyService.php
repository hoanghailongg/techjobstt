<?php

namespace App\Services;

use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\Session;

class CompanyService
{
    public function get()
    {
        return Company::latest()->get();
    }

    public function update($company, $request): bool
    {
        try {
            $company->full_name = (string)$request->full_name;
            $company->name = $request->name;
            $company->phone = $request->phone;
            $company->address = $request->address;
            $company->is_active = $request->is_active;
            $company->save();
            Session::flash('success', 'Cập nhật nhà tuyển dụng thành công.');
            return true;
        } catch (Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return false;
        }
    }
    public function destroy($employer): bool
    {
        return $employer->delete();
    }

    public function create($request): bool
    {
        try {
            $company = new Company();
            $company->email = $request->email;
            $company->full_name = $request->full_name;
            $company->name = $request->name;
            $company->phone = $request->phone;
            $company->address = $request->address;
            $company->is_active = $request->is_active;
            $company->save();
            Session::flash('success', 'Tạo mới nhà tuyển dụng thành công.');
        } catch (Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return false;
        }
        return true;
    }

}

<?php

namespace App\Http\Controllers\Employer;

use App\Http\Requests\CompanyRequest;
use App\Http\Requests\EmployerRequest;
use App\Models\Company;
use App\Services\ApplyService;
use App\Services\CompanyService;
use App\Services\UploadService;
use Exception;
use Illuminate\Support\Facades\Session;

class EmployerProfileController
{
    protected $applyService;
    protected $companyService;
    protected $upload;

    public function __construct(ApplyService $applyService, CompanyService $companyService, UploadService $upload)
    {
        $this->applyService = $applyService;
        $this->companyService = $companyService;
        $this->upload = $upload;
    }

    public function index()
    {
        $company = Company::where('id', \Auth::guard('employer')->user()->id)->first();
        $countJobOfCompany = $this->applyService->countJobOfCompany();
        $countFollowOfCompany = $this->applyService->countFollowOfCompany();
        return view('employer.profile', [
            'title' => 'Cập nhật thông tin cá nhân',
            'company' => $company,
            'countJobOfCompany' => $countJobOfCompany,
            'countFollowOfCompany' => $countFollowOfCompany
        ]);
    }

    public function update(EmployerRequest $request, Company $profile)
    {
        try {
            if (!($profile->id === \Auth::guard('employer')->user()->id)) {
                return back()->withInput()->with('error', 'Không tìm thấy thông tin người dùng.');
            }
            $detailsCompany = Company::where('id', $profile->id)->first();
            $detailsCompany->full_name = (string)$request->input('full_name');
            $detailsCompany->phone = $request->input('phone');
            $detailsCompany->name = $request->input('name');
            $detailsCompany->address = $request->input('address');
            $detailsCompany->url = $request->input('url');
            if ($request->hasFile('avatar')) {
                $detailsCompany->avatar = $this->upload->store($request->file('avatar'));
            }
            if ($request->filled('password')) {
                $detailsCompany->password = bcrypt($request->input('password'));
            }

            $detailsCompany->save();
            return redirect()->route('employer.profile.index')->with('success','Cập nhật thông tin cá nhân thành công!');
        } catch (Exception $e) {
            return back()->with('error', 'Cập nhật không thành công, vui lòng thử lại.');
        }

    }
}

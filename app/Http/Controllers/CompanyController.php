<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\RedirectResponse;

class CompanyController extends Controller
{
    protected $companyService;
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.employer.list', [
            'title' => 'Danh sách nhà tuyển dụng',
            'companies' => $this->companyService->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $employer)
    {
        return view('admin.employer.edit', [
            'title' => 'Chỉnh sửa nhà tuyển dụng',
            'company' => $employer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $employer)
    {
        $result = $this->companyService->update($employer, $request);

        if ($result) {
            return redirect()->route('admin.employers.index');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $employer)
    {
        $result = $this->companyService->destroy($employer);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa người tuyển dụng thành công'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

    public function create()
    {
        return view('admin.employer.add', [
            'title' => 'Thêm mới nhà tuyển dụng',
        ]);
    }

    public function store(CompanyRequest $request): RedirectResponse
    {
        $this->companyService->create($request);
        return redirect()->route('admin.employers.index');
    }
}

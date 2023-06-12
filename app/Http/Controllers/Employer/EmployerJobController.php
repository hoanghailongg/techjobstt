<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployerJobRequest;
use App\Http\Requests\JobRequest;
use App\Models\Company;
use App\Models\Following;
use App\Models\Job;
use App\Services\JobService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployerJobController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employer.jobs.list', [
            'title' => 'Danh sách công việc',
            'jobs' => $this->jobService->getJobInCompany(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employer.jobs.add', [
            'title' => 'Thêm mới công việc',
            'languages' => $this->jobService->getLanguages(),
            'cities' => $this->jobService->getCities(),
            'companies' => $this->jobService->getCompanies(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployerJobRequest $request): RedirectResponse
    {
        $this->jobService->create($request);
        return redirect()->route('employer.jobs.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $com_id = \Auth::guard('employer')->id();
        $jobDetails = Job::where(['company_id' => $com_id, 'id' => $job->id])->first();
        if (!$jobDetails) {
            return back()->withInput()->with('error', 'Không tồn tại công việc này, vui lòng kiểm tra lại thông tin.');
        }
        return view('employer.jobs.edit', [
            'title' => 'Chỉnh sửa công việc',
            'job' => $job,
            'languages' => $this->jobService->getLanguages(),
            'cities' => $this->jobService->getCities(),
            'companies' => $this->jobService->getCompanies(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployerJobRequest $request, Job $job): RedirectResponse
    {
        $com_id = \Auth::guard('employer')->id();
        $jobDetails = Job::where(['company_id' => $com_id, 'id' => $job->id])->first();
        if (!$jobDetails) {
            return back()->withInput()->with('error', 'Không tồn tại công việc này, vui lòng kiểm tra lại thông tin.');
        }
        $result = $this->jobService->update($jobDetails, $request);
        if ($result) {
            return redirect()->route('employer.jobs.index');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): JsonResponse
    {
        $result = $this->jobService->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa công việc thành công'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}

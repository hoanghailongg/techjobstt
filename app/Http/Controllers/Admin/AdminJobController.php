<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Services\JobService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminJobController extends Controller
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
        return view('admin.jobs.list', [
            'title' => 'Danh sách công việc',
            'jobs' => $this->jobService->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jobs.add', [
            'title' => 'Thêm mới công việc',
            'languages' => $this->jobService->getLanguages(),
            'cities' => $this->jobService->getCities(),
            'companies' => $this->jobService->getCompanies(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request): RedirectResponse
    {
        $this->jobService->create($request);
        return redirect()->route('admin.jobs.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', [
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
    public function update(JobRequest $request, Job $job): RedirectResponse
    {
        $result = $this->jobService->update($job, $request);

        if ($result) {
            return redirect()->route('admin.jobs.index');
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

    public function showStatus(Job $job)
    {
        return view('admin.jobs.view-status', [
            'job' => $job
        ]);
    }

    public function updateStatus(Request $request): JsonResponse
    {

        $result = $this->jobService->updateStatus($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Cập nhật trạng thái thành công.'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Cập nhật trạng thái thất bại.'
        ]);
    }
}

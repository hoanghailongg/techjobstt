<?php

namespace App\Services;

use App\Models\City;
use App\Models\Company;
use App\Models\Job;
use App\Models\Language;
use Exception;
use Illuminate\Support\Facades\Session;

class JobService
{

    protected $upload;

    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }

    public function get()
    {
        return Job::latest()->get();
    }

    public function getJobInCompany()
    {
        return Job::latest()->where('company_id', \Auth::guard('employer')->id())->get();
    }

    public function getLanguages()
    {
        return Language::latest()->get(['id', 'name']);
    }

    public function getCities()
    {
        return City::orderBy('id', 'desc')->get();
    }

    public function getCompanies()
    {
        return Company::orderBy('id', 'desc')->get();
    }

    public function create($request): bool
    {
        try {
            $job = new Job();
            $job->title = (string)$request->title;
            $job->level = $request->input('level');
            $job->salary_start = $request->input('salary_start');
            $job->salary_end = $request->input('salary_end');
            $job->experience = $request->input('experience');
            $job->gender = $request->input('gender');
            $job->content = $request->input('content');
            $job->date_end = date('Y-m-d', strtotime($request->input('date_end')));
            $job->city_id = $request->input('city');
            $job->company_id = \Auth::guard('employer')->id();
            $job->languages = json_encode($request->input('languages'));
            $job->save();
            Session::flash('success', 'Tạo mới công việc thành công.');
        } catch (Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return false;
        }
        return true;
    }

    public function destroy($request): bool
    {
        $id = $request->input('id');

        $job = Job::where('id', $id)->first();

        if ($job) {
            return $job->delete();
        }

        return false;
    }

    public function update($job, $request): bool
    {
        try {
            $job->title = (string)$request->title;
            $job->level = $request->input('level');
            $job->salary_start = $request->input('salary_start');
            $job->salary_end = $request->input('salary_end');
            $job->experience = $request->input('experience');
            $job->gender = $request->input('gender');
            $job->content = $request->input('content');
            $job->date_end = date('Y-m-d', strtotime($request->input('date_end')));
            $job->city_id = $request->input('city');
            $job->languages = json_encode($request->input('languages'));
            $job->save();
            Session::flash('success', 'Cập nhật công việc thành công.');
            return true;
        } catch (Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return false;
        }
    }

    public function updateStatus($request): bool
    {
        try {
            $task_id = $request->task_id;
            $status = in_array((int)$request->status, [0, 1, 2]) ? (int)$request->status : 0;
            return Job::where(['id' => $task_id])->first()->update(['is_active' => $status]);
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return false;
        }
    }


}

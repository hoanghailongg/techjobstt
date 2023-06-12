<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Following;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class ApplyService
{

    public function countFollow()
    {
        return Following::count();
    }

    public function countFollowOfCompany()
    {
        $com_id = \Auth::guard('employer')->id(); // ID của công ty bạn muốn lấy các bản ghi từ bảng followings
        return Following::whereHas('job', function ($query) use ($com_id) {
            $query->where('company_id', $com_id);
        })->count();
    }

    public function countUser()
    {
        return User::count();
    }

    public function countUserApplyToCompany()
    {
        $com_id = \Auth::guard('employer')->id();
        return Following::whereHas('job', function ($query) use ($com_id) {
            $query->where('company_id', $com_id);
        })
            ->distinct('user_id') // Loại bỏ các bản ghi trùng lặp dựa trên trường user_id
            ->count('user_id');
    }

    public function countJob()
    {
        return Job::count();
    }

    public function countJobOfCompany()
    {
        $com_id = \Auth::guard('employer')->id();
        return Job::where('company_id', $com_id)->count();
    }

    public function countFollowAccept()
    {
        $com_id = \Auth::guard('employer')->id();
        return Following::where('status', 1)
            ->whereHas('job', function ($query) use ($com_id) {
                $query->where('company_id', $com_id);
            })->count();
    }

    public function getListJobs()
    {
        return Job::all();
    }

    public function getListJobsOfCompany()
    {
        return Job::where('company_id', \Auth::guard('employer')->id())->get();
    }

    public function getListFollow(int $int)
    {
        return Following::limit($int)->get();
    }

    public function getListFollowOfCompany(int $int)
    {
        $com_id = \Auth::guard('employer')->id();
        return Following::whereHas('job', function ($query) use ($com_id) {
            $query->where('company_id', $com_id);
        })->limit($int)->get();
    }

    public function countCompany()
    {
        return Company::count();
    }

    public function getAllListFollows()
    {
        return Following::all();
    }

    public function getAllListFollowsOfCompany()
    {
        $com_id = \Auth::guard('employer')->id();
        return Following::whereHas('job', function ($query) use ($com_id) {
            $query->where('company_id', $com_id);
        })->get();
    }

    public function searchById($id)
    {
        return Following::where('id', $id)->first();
    }

    public function searchByIdInCompany($id)
    {
        $com_id = \Auth::guard('employer')->id();
        return Following::whereHas('job', function ($query) use ($com_id) {
            $query->where('company_id', $com_id);
        })->where('id', $id)->first();
    }

    public function updateStatus($request): bool
    {
        try {
            $follow_id = $request->follow_id;
            $status = in_array((int)$request->status, [0,1,2]) ? (int)$request->status : 0;
            return Following::where(['id' => $follow_id])->first()->update(['status' => $status]);

        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return false;
        }
    }

    public function updateStatusCompany($request)
    {
        try {
            $follow_id = $request->follow_id;
            $status = in_array((int)$request->status, [0, 1, 2]) ? (int)$request->status : 0;
            $com_id = \Auth::guard('employer')->id();
            $follow = Following::whereHas('job', function ($query) use ($com_id) {
                $query->where('company_id', $com_id);
            })->where(['id' => $follow_id])->first();
            if ($follow) {
                return $follow->update(['status' => $status]);
            }
            return false;
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
            return false;
        }
    }
}

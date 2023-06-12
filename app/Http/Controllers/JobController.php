<?php

namespace App\Http\Controllers;

use App\Models\Following;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Job $job)
    {
        $job->update([
            'count' => $job->count + 1
        ]);

        $searchTerm = json_decode($job->languages);

        $sameJob = Job::active()->whereRaw("JSON_CONTAINS(languages, CAST(? AS JSON))", [$searchTerm[0]])
            ->limit(6)
            ->get();
        $user = auth()->user();
        $followingsCount = isset($user) && $user->followings() !== null ? $user->followings()->count() : 0;
        $follow = [];
        if ($followingsCount > 0) {
            $follow = $user->followings()->where('task_id', $job->id)->first();
        }

        return view('jobs.details', [
            'title' => $job->title,
            'job' => $job,
            'sameJob' => $sameJob,
            'follow' => $follow
        ]);
    }

    public function search(Request $request)
    {
        $jobName = $request->input('title');
        $language = $request->input('language');
        $location = $request->input('location');

        $query = Job::query();

        if ($jobName) {
            $query->where('title', 'LIKE', '%' . $jobName . '%');
        }

        if ($language) {
            $query->whereRaw("JSON_CONTAINS(languages, CAST(? AS JSON))", [$language]);
        }

        if ($location) {
            $query->where('city_id', $location);
        }

        $jobs = $query->active()->get();

        return view('jobs.index', compact('jobs'));
    }

    public function apply(Request $request)
    {
        if (\Auth::guard('admin')->check() || \Auth::guard('employer')->check()) {
            return back()->with('error', 'Bạn không thể nộp đơn vào công việc này.');
        }

        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'task_id' => 'required|exists:tasks,id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $followingsCount = isset($user->followings) ? $user->followings()->count() : 0;
        if ($followingsCount > 0) {
            $hasPendingFollowing = $user->followings()
                ->where('status', 'pending')
                ->where('task_id', $request->task_id)
                ->exists();

            if ($hasPendingFollowing) {
                return back()->with('error', 'Bạn đã nộp đơn vào công việc này trước đó và đang chờ duyệt.');
            }
        }

        $job = Job::active()->findOrFail($request->task_id);
        Following::create([
            'user_id' => $user->id,
            'task_id' => $job->id,
            'status' => 0,
        ]);

        return back()->with('success', 'Bạn đã nộp đơn thành công, vui lòng chờ kết quả.');
    }
}

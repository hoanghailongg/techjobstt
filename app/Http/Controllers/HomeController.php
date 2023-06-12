<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\City;
use App\Models\Following;
use App\Models\Job;
use App\Models\Language;
use App\Models\User;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $upload;

    public function __construct(UploadService $upload)
    {
        $this->upload = $upload;
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        // get list of jobs
        $jobs = Job::latest()->active()->orderBy('id', 'desc')->limit(6)->get();

        return view('home', [
            'jobs' => $jobs
        ]);
    }

    public function profile()
    {
        $cities = City::orderBy('id', 'desc')->get();
        $jobSubmitted = Following::where('user_id', \Auth::user()->id)->count();
        return view('profile', [
            'profile' => \Auth::user(),
            'cities' => $cities,
            'jobSubmitted' => $jobSubmitted
        ]);
    }

    public function update(UserRequest $request)
    {
        $id_user = \Auth::user()->id;
        $user = User::where('id', $id_user)->first();
        if (!$user) {
            return back()->withInput()->with('error', 'Không tìm thấy thông tin người dùng.');
        }

        if ($request->hasFile('avatar')) {
            $user->avatar = $this->upload->store($request->file('avatar'));
        }
        $user->username = $request->input('username');
        $user->full_name = $request->input('full_name');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->city = $request->input('city');
        $user->address = $request->input('address');
        $user->save();
        return back()->with('success', 'Cập nhật thông tin thành công.');
    }
}

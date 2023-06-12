<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Services\ApplyService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AdminController extends Controller
{

    protected $applyService;

    public function __construct(ApplyService $applyService)
    {
        $this->applyService = $applyService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // tổng số đơn đã nộp
        $countFollow = $this->applyService->countFollow();
        #Status
        //0. Chờ duyệt
        //1. Đã duyệt
        //2. Từ chối

        //tổng người dùng
        $countUser = $this->applyService->countUser() ?? 0;

        // tổng số công ty
        $countCompanies = $this->applyService->countCompany();

        // tổng số jobs
        $countJob = $this->applyService->countJob();
        // 4 công việc mới nhất
        $listNewJob = $this->applyService->getListJobs();
        // 10 đơn nộp gần nhất
        $listFollow = $this->applyService->getListFollow(10) ?? [];

        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'countFollow' => $countFollow,
            'countUser' => $countUser,
            'countJob' => $countJob,
            'countCompany' => $countCompanies,
            'listNewJob' => $listNewJob,
            'listFollow' => $listFollow,
        ]);

    }

    public function listUser()
    {
        return view('admin.users.index', [
            'title' => 'Danh sách người dùng',
            'users' => User::orderBy('id', 'desc')->get()
        ]);
    }

    public function updateUser(Request $request)
    {
        try {
            $id = $request->user;
            $status = (int)$request->status;
            $status === 0 ? $statusUpdate = 1 : $statusUpdate = 0;
            $user = User::where(['id' => $id])->first();
            if ($user) {
                User::where(['id' => $id])->update(['is_active' => $statusUpdate]);
                return response()->json([
                    'error' => false,
                    'message' => 'Cập nhật trạng thái người dùng thành công'
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'error' => true
            ]);
        }
    }

    public function destroyUser(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                'status' => 'success',
                'data' => [
                    'message' => 'Xóa thành công!',
                ]
            ], ResponseAlias::HTTP_OK);
        } catch (\Exception $ex) {
            return response()->json([
                'status' => 'error',
                'data' => [
                    'message' => 'Xóa không thành công, vui lòng kiểm tra lại thông tin!',
                ]
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }
}

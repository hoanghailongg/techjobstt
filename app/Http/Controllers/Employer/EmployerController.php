<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Services\ApplyService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EmployerController extends Controller
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
        $countFollowOfCompany = $this->applyService->countFollowOfCompany();
        #Status
        //0. Chờ duyệt
        //1. Đã duyệt
        //2. Từ chối
        //tổng người dùng đã nộp đơn vào công ty
        $countUserApplyToCompany = $this->applyService->countUserApplyToCompany() ?? 0;
        // tổng số đơn đã duyệt
        $countFollowAccept = $this->applyService->countFollowAccept();
        // tổng số jobs của công ty
        $countJobOfCompany = $this->applyService->countJobOfCompany();
        // 4 công việc mới nhất
        $getListJobsOfCompany = $this->applyService->getListJobsOfCompany();
        // 10 đơn nộp gần nhất
        $getListFollowOfCompany = $this->applyService->getListFollowOfCompany(10) ?? [];

        return view('employer.dashboard',[
            'title' => 'Dashboard',
            'countFollowOfCompany' => $countFollowOfCompany,
            'countUserApplyToCompany' => $countUserApplyToCompany,
            'countJobOfCompany' => $countJobOfCompany,
            'countFollowAccept' => $countFollowAccept,
            'getListJobsOfCompany' => $getListJobsOfCompany,
            'getListFollowOfCompany' => $getListFollowOfCompany,
        ]);

    }

    public function listUser()
    {
        return view('admin.users.index', [
            'title' => 'Danh sách người dùng',
            'users' => User::orderBy('id', 'desc')->get()
        ]);
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

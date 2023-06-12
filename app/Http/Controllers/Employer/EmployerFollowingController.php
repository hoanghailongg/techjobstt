<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Following;
use App\Services\ApplyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployerFollowingController extends Controller
{
    protected $applyService;

    public function __construct(ApplyService $applyService)
    {
        $this->applyService = $applyService;
    }

    public function index()
    {
        return view('employer.follow.list', [
            'title' => 'Danh sách đơn xin việc',
            'follows' => $this->applyService->getAllListFollowsOfCompany()
        ]);
    }

    public function showStatus(Following $follow)
    {
        return view('employer.follow.view-status', [
            'follow' => $this->applyService->searchByIdInCompany($follow->id)
        ]);
    }

    public function updateStatus(Request $request): JsonResponse
    {

        $result = $this->applyService->updateStatusCompany($request);

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

    public function showDetail(Following $follow)
    {
        // check
        $com_id = \Auth::guard('employer')->id();
        $detailsFollow = Following::whereHas('job', function ($query) use ($com_id){
            $query->where('company_id', $com_id);
        })->where('id', $follow->id)->first();

        if (!$detailsFollow) {
            return back()->with('error', 'Không tìm thấy thông tin đơn xin việc.');
        }

        return view('employer.follow.details',[
            'title' => 'Chi tiết đơn xin việc',
            'follow' => $detailsFollow,
        ]);
    }
}

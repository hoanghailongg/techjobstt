<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Following;
use App\Services\ApplyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    protected $applyService;

    public function __construct(ApplyService $applyService)
    {
        $this->applyService = $applyService;
    }

    public function index()
    {
        return view('admin.follow.list', [
            'title' => 'Danh sách đơn xin việc',
            'follows' => $this->applyService->getAllListFollows()
        ]);
    }

    public function showStatus(Following $follow)
    {
        return view('admin.follow.view-status', [
            'follow' => $this->applyService->searchById($follow->id)
        ]);
    }

    public function updateStatus(Request $request): JsonResponse
    {

        $result = $this->applyService->updateStatus($request);

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

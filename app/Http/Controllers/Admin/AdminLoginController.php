<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.auth.login', [
            'title' => 'Đăng nhập quản trị - ' . config('app.name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|string|email:filter',
            'password' => 'required|string'
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember_me = !empty($request->remember);

        $admin = Admin::where(['email' => $credential['email']])->first();

        if (Auth::guard('admin')->attempt($credential)) {
            Auth::guard('admin')->login($admin, $remember_me);
            return response()->json(['message' => 'Đăng nhập thành công, vui lòng đợi chuyển hướng...'], ResponseAlias::HTTP_OK);
        }

        return response()->json(['message' => 'Đăng nhập không thành công, vui lòng kiểm tra lại thông tin.'], 401);
    }

    /**
     * Logout current logged in admin.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

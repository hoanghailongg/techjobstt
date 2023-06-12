<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Company;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EmployerLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('employer.auth.login', [
            'title' => 'Đăng nhập người tuyển dụng - ' . config('app.name')
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

        $employer = Company::active()->where(['email' => $credential['email']])->first();

        if ($employer) {
            if (Auth::guard('employer')->attempt($credential)) {
                Auth::guard('employer')->login($employer, $remember_me);
                return response()->json(['message' => 'Đăng nhập thành công, vui lòng đợi chuyển hướng...'], ResponseAlias::HTTP_OK);
            }
        } else {
            return response()->json(['message' => 'Đăng nhập không thành công, tài khoản chưa được kích hoạt.'], 401);
        }
        return response()->json(['message' => 'Đăng nhập không thành công, vui lòng kiểm tra lại thông tin.'], 401);
    }

    public function register()
    {
        return view('employer.auth.register');
    }

    public function registerAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'full_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:12'],
            'name' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $validator->setAttributeNames([
            'email' => 'địa chỉ email',
            'password' => 'mật khẩu',
            'full_name' => 'họ và tên',
            'phone' => 'số điện thoại',
            'name' => 'tên công ty',
            'address' => 'địa chỉ'
        ]);

        $validator->setCustomMessages([
            'email.required' => 'Địa chỉ email là bắt buộc.',
            'email.string' => 'Địa chỉ email phải là một chuỗi.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Địa chỉ email không được vượt quá :max ký tự.',
            'email.unique' => 'Địa chỉ email đã được sử dụng.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là một chuỗi.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Company::create([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'full_name' => $request['full_name'],
            'phone' => $request['phone'],
            'name' => $request['name'],
            'address' => $request['address'],
        ]);

        return redirect()->route('employer.login')->with('success', 'Đăng ký tài khoản thành công, đăng nhập để sử dụng.');
    }

    /**
     * Logout current logged.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('employer')->logout();
        return redirect()->route('employer.login');
    }
}

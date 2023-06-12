<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Đăng Nhập'
        ]);
    }

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
        $user = User::active()->where(['email' => $credential['email']])->first();
        $admin = Admin::where(['email' => $credential['email']])->first();
        if ($user && Auth::attempt($credential)) {
            Auth::guard('web')->login($user, $remember_me);
            return response()->json(['message' => 'Đăng nhập thành công'], 200);
        } elseif ($admin && Auth::guard('admin')->attempt($credential)) {
            Auth::guard('admin')->login($admin, $remember_me);
            return response()->json(['message' => 'Đăng nhập thành công'], 200);
        } else {
            return response()->json(['message' => 'Đăng nhập không thành công, vui lòng kiểm tra lại thông tin.'], 401);
        }
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public
    function register()
    {
        return view('auth.register');
    }

    public
    function registerAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:12'],
        ]);

        $validator->setAttributeNames([
            'username' => 'tên tài khoản',
            'email' => 'địa chỉ email',
            'password' => 'mật khẩu',
            'phone' => 'số điện thoại',
            'full_name' => 'họ và tên'
        ]);

        $validator->setCustomMessages([
            'username.required' => 'Tên người dùng là bắt buộc.',
            'username.string' => 'Tên người dùng phải là một chuỗi.',
            'username.min' => 'Tên người dùng phải có ít nhất :min ký tự.',
            'username.max' => 'Tên người dùng không được vượt quá :max ký tự.',
            'username.unique' => 'Tên người dùng đã được sử dụng.',
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

        User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'full_name' => $request['full_name'],
            'phone' => $request['phone'],
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký tài khoản thành công, đăng nhập để sử dụng.');
    }
}

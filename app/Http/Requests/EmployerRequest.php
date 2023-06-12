<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'full_name' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:12'],
            'address' => ['required', 'string', 'max:255'],
            'size' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ];
        if ($this->filled('password')) {
            $rules['old_password'] = 'required';
            $rules['password'] = 'required|min:8|confirmed';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'full_name' => 'tên người phụ trách',
            'name' => 'tên công ty',
            'phone' => 'số điện thoại liên hệ',
            'address' => 'địa chỉ',
            'old_password' => 'mật khẩu cũ'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'avatar.image' => 'Ảnh đại diện phải là một file hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpeg, png, jpg hoặc gif.',
            'avatar.max' => 'Kích thước ảnh đại diện không được vượt quá 2MB.',
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->filled('old_password')) {
                $user = $this->user();
                $oldPassword = $this->input('old_password');

                if (!Hash::check($oldPassword, $user->password)) {
                    $validator->errors()->add('old_password', 'Mật khẩu cũ không chính xác.');
                }
            }
        });
    }
}

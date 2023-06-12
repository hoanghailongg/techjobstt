<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $userId = auth()->id();
        $rules = [
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($userId),],
            'full_name' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:12'],
            'gender' => 'required|in:1,2',
            'city' => 'required|numeric',
            'address' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'full_name' => 'họ tên',
            'username' => 'tên người dùng',
            'phone' => 'số điện thoại',
            'address' => 'địa chỉ',
            'avatar' => 'ảnh đại diện',
            'city' => 'tỉnh/thành phố',
            'gender' => 'giới tính'
        ];
    }

    public function messages()
    {
        return [
            'gender.in' => 'Giới tính không hợp lệ.',
        ];
    }
}

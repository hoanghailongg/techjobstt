<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
            'phone' => ['required', 'string', 'max:12'],
            'name' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
        ];

        if ($this->method() == 'POST') {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users,email'];
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'email' => 'email',
            'full_name' => 'tên người phụ trách',
            'name' => 'tên công ty',
            'phone' => 'số điện thoại liên hệ',
            'address' => 'địa chỉ',
        ];
    }
}

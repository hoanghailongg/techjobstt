<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class JobRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'level' => ['nullable', 'string', 'max:100'],
            'salary_start' => 'required|integer|min:0',
            'salary_end' => 'required|integer|min:0|gt:salary_start',
            'experience' => ['nullable', 'string', 'max:100'],
            'gender' => ['nullable', 'string', 'max:100'],
            'content' => ['required', 'string'],
            'date_end' => [
                'required',
                'date',
                'after:'.Carbon::now()->format('m/d/Y')
            ],
            'city' => ['required'],
            'company' => ['required'],
            'languages' => 'required|array|min:1',
            'languages.*' => 'exists:languages,id',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'title' => 'tiêu đề',
            'level' => 'cấp bậc',
            'salary_start' => 'lương thấp nhất',
            'salary_end' => 'lương cao nhất',
            'experience' => 'kinh nghiệm',
            'gender' => 'giới tính',
            'content' => 'nội dung',
            'date_end' => 'hạn nộp',
            'city' => 'địa điểm làm việc',
            'company' => 'công ty',
            'languages' => 'ngôn ngữ lập trình'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'min:3',
                'max:200'
            ],
            'description' => 'string|nullable|max:300',
            'content' => 'required',
            'category' => 'string|nullable|max:255',
            'thumb' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'slug' => [
                'required',
                'min:3',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                'max:120',
                'unique:posts,slug'
            ]
        ];

        if (in_array($this->method(), ['PUT', 'PATCH', 'DELETE'])) {
            $rules['slug'] = [
                'required',
                'string',
                'max:120',
                'unique:posts,slug,' . $this->post->id
            ];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'title' => 'tiêu đề trang',
            'slug' => 'đường dẫn (URL)',
            'content' => 'nội dung',
            'description' => 'mô tả',
            'category' => 'danh mục',
            'thumb' => 'hình ảnh'
        ];
    }
}

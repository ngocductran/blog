<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
        return [
            'category' => 'required|unique:categories,category|min:3|max:70',
            'slug' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'category.required' => 'Vui lòng nhập Chuyên mục',
            'category.min'=>'Tên chuyên mục gồm ít nhất 3 ký tự!',
            'category.max'=>'Tên chuyên mục gồm tối đa 50 ký tự!',
            'category.unique' => 'Chuyên mục đã tồn tại',
            'slug.required' => 'Vui lòng chọn Đường dẫn'
        ];
    }
}

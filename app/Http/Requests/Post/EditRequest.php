<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'avatar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập title',
            'description.required' => 'Vui lòng nhập description',
            'avatar.image' => 'Vui lòng chọn hình ảnh',
            'avatar.mimes' => 'Hình ảnh phải có định dạng jpg, png, jpeg, gif, svg',
            'category.required' => 'Vui lòng nhập category',
            'content.required' => 'Vui lòng nhập content'
        ];
    }
}

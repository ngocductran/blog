<?php

namespace App\Http\Requests\Post;

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
            'title' => 'required',
            'description' => 'required',
            'avatar' => 'required',
            'category' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập title',
            'description.required' => 'Vui lòng nhập description',
            'avatar.required' => 'Vui lòng chọn avatar',
            'category.required' => 'Vui lòng nhập category',
            'content.required' => 'Vui lòng nhập content'
        ];
    }
}

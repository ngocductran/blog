<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'username' => 'required|min:5|unique:users,username',
            'password' => 'required',
            'confirn_password' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập tên tài khoản admin !',
            'username.min' => 'Tên tài khoản admin ít nhất 5 kí tự !',
            'username.unique' => 'Tên tài khoản admin đã tồn tại !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'confirn_password.required' => 'Vui lòng nhập lại mật khẩu !',
            'confirn_password.same' => 'Mật khẩu nhập lại không khớp !'
        ];
    }
}

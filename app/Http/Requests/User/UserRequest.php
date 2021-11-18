<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'fullname'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'repeat_password'=>'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required'=>'Hãy nhập đầy đủ tên của bạn',
            'email.required'=>'Vui lòng nhập email',
            'email.unique'=>'Email này đã được đăng ký trước đó',
            'email.email'=>'Email không hợp lệ',
            'password.required'=>'Mật khẩu không thể bỏ trống',
            'repeat_password.required'=>'Hãy xác nhận lại mật khẩu',
            'repeat_password.same'=>'Mật khẩu nhập lại không chính xác',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự'
        ];
    }
}

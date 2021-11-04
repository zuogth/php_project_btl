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
            'username'=>'required|unique:users',
            'password'=>'required|min:6',
            'terms'=>'required',
            're-password'=>'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required'=>'Hãy nhập đầy đủ tên của bạn',
            'username.required'=>'Vui lòng nhập tên tài khoản',
            'username.unique'=>'Tài khoản này đã có người sử dụng',
            'password.required'=>'Mật khẩu không thể bỏ trống',
            're-password.required'=>'Hãy xác nhận lại mật khẩu',
            're-password.same'=>'Mật khẩu nhập lại không chính xác',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự',
            'terms.required'=>'Hãy đồng ý với điều khoản của chúng tôi'
        ];
    }
}

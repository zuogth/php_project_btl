<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserBillRequest extends FormRequest
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
            'email'=>'unique:users',
        ];
    }

    public function messages()
    {
        return [
            'fullname.required'=>'Hãy nhập đầy đủ tên của bạn',
            'email.unique'=>'Email này đã được đăng ký trước đó'
        ];
    }
}

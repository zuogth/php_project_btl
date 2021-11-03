<?php

namespace App\Http\Requests\Speciality;

use Illuminate\Foundation\Http\FormRequest;

class SpecialityRequest extends FormRequest
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
            'typename'=>'required',
            'mata'=>'required',
            'typeproduct'=>'required',
            'description'=>'required'
        ];
    }

    public function messages()
    {
        return [
          'typename.required'=>'Hãy nhập tên đặc tính',
          'mata.required'=>'Hãy nhập đặc tính',
          'typeproduct.required'=>'Hãy chọn thể loại cho đặc tính',
          'description.required'=>'Hãy viết một ít mô tả',
        ];
    }
}

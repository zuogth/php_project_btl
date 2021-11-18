<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'categoryname'=>'required',
            'description'=>'required',
            'thumb'=>'required'
        ];
    }

    public function messages():array
    {
        return [
            'categoryname.required'=>"Vui lòng nhập tên danh mục",
            'thumb.required'=>'Hãy chọn ảnh',
            'description.required'=>'Hãy viết mô tả cho danh mục này'
        ];
    }
}

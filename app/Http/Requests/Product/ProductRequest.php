<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'productname'=>'required',
            'images'=>'required',
            'pricesell'=>'integer|min:100000',
            'category_id'=>'integer'
        ];
    }

    public function messages():array
    {
        return [
            'productname.required'=>'Vui lòng nhập tên sản phẩm',
            'images.required'=>'Hãy chọn ảnh sản phẩm',
            'pricesell.integer'=>'Hãy nhập giá sản phẩm',
            'pricesell.min'=>'Giá ít nhất phải 100.000',
            'category_id.integer'=>'Hãy chọn thể loại cho sản phẩm'
        ];
    }
}

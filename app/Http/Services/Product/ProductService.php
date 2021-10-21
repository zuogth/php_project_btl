<?php

namespace App\Http\Services\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

class ProductService
{
    public function findMenu()
    {
        return Category::where('status',1)->get();
    }

    public function create($request)
    {
        if($this->isValidPrice($request)==false) return false;
        try{
            $request->except('_token');
            Product::create($request->all());
            Session::flash('success','Thêm sản phẩm thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function findAll()
    {
        Paginator::useBootstrap();
        return Product::with('category')->orderBy('id','asc')->paginate(10);
    }

    public function edit($product,$request){
        $product->fill($request->input());
        $product->save();
        Session::flash('success','Cập nhật thông tin sản phẩm thành công');
        return true;
    }

    private function isValidPrice($request)
    {
        if($request->input('price_sale')>=$request->input('price')){
            Session::flash('price_sale','Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }
        return true;
    }
}

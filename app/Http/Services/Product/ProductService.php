<?php

namespace App\Http\Services\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductService
{
    public function findMenu()
    {
        return Category::where('status',1)->get();
    }

    public function findBrand()
    {
        return Brand::all();
    }

    public function create($product,$request)
    {
        if($this->isValidPrice($request)==false) return false;
        try{
            $request->except('_token');
            $product->fill($request->all());
            $product->productcode=Str::slug($request->productname,'');
            $product->save();
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
        if($request->input('priceentry')>=$request->input('pricesell')){
            Session::flash('priceentry','Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }
        return true;
    }
}

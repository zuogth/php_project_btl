<?php

namespace App\Http\Services\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Speciality;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductService
{
    public function findMenu($code)
    {
        $cate=Category::where('categorycode',$code)->first();
        return Category::where('parent_id','=',$cate->id)->get();
    }

    public function findBrand()
    {
        return Brand::all();
    }

    public function create($spec_id,$product,$request)
    {
        if($this->isValidPrice($request)==false) return false;
        try{
            $request->except('_token');
            $product->fill($request->all());
            $product->productcode=Str::slug($request->productname,'-');
            $product->save();
            $product->specialities()->attach($spec_id);
            Session::flash('success','Thêm sản phẩm thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function findByCategory($category_id)
    {
        Paginator::useBootstrap();
        return DB::table('product')
                    ->join('category','product.category_id','=','category.id')
                    ->where('category.parent_id',$category_id)
                    ->select('product.*','category.categoryname','category.parent_id')
                    ->orderBy('product.id')
                    ->paginate(10);
    }

    public function findSpeciality($code)
    {
        return Speciality::with('products')->where('typeproduct',$code)->get();
    }

    public function findSpecialityByProduct_id($product_id)
    {
        return DB::table('speciality')
                ->join('product_speciality','speciality.id','=','product_speciality.speciality_id')
                ->where('product_speciality.product_id',$product_id)
                ->select('speciality.*')
                ->get();
    }

    public function edit($product,$request,$spec_id){
        $product->fill($request->input());
        $product->save();
        $product->specialities()->attach($spec_id);
        Session::flash('success','Cập nhật thông tin sản phẩm thành công');
        return true;
    }

    public function findSpecialityByType($code)
    {
        return DB::table('speciality')
                ->where('typeproduct',$code)
                ->select('code')
                ->groupBy('code')
                ->get();
    }

    public function delete($request)
    {
        $id=$request->input('id');
        $product=Product::find($id);
        if($product)
        {
            DB::table('product_bill')
                ->where('product_id','=',$id)
                ->delete();
            DB::table('product_speciality')
                ->where('product_id','=',$id)
                ->delete();
            return Product::where('id',$id)->delete();
        }
        return false;
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

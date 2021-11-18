<?php

namespace App\Http\Services\Admin\Product;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Images;
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

    public function findAll()
    {
        return Product::with('category')->get();
    }

    public function findById($ids)
    {
        $array=[];
        foreach ($ids as $id){
            array_push($array,Product::with('category')->where('id',$id)->first());
        }
        return $array;
    }

    public function findByImagesSpec($id)
    {
        return Product::with(['imagess','specialities'])->where('id',$id)->first();
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
            $count=$request->input('countImg');
            for ($i=1;$i<=$count;$i++){
                if($request->input('images-'.$i)!=null){
                    $product->imagess()->create([
                        'image'=>$request->input('images-'.$i),
                        'product_id'=>$product->id
                    ]);
                }
            }
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
        $pb=DB::table('product_bill')
            ->join('bill','bill.id','=','product_bill.bill_id')
            ->where('bill.bill_type','=','bill')
            ->select('product_bill.*');
        $receipt=DB::table('product')
                    ->select('product.id',DB::raw('sum(product_receipt.quantily) as count'))
                    ->leftJoin('product_receipt','product_receipt.product_id','=','product.id')
                    ->groupBy('product.id');
        return DB::table('product')
                    ->select('category.parent_id','product.*','category.categoryname',
                        DB::raw('if(sum(pb.quantily) is null,0,sum(pb.quantily)) as sell'),
                        DB::raw('if(receipt.count is null,0,receipt.count) as import'))
                    ->join('category','product.category_id','=','category.id')
                    ->leftJoinSub($pb,'pb','product.id','=','pb.product_id')
                    ->joinSub($receipt,'receipt','receipt.id','=','product.id')
                    ->where('category.parent_id',$category_id)
                    ->groupBy('product.id')
                    ->get();
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
        $product->productcode=Str::slug($request->productname,'-');
        $product->save();
        DB::table('product_speciality')
            ->where('product_id','=',$product->id)
            ->delete();
        $product->specialities()->attach($spec_id);
        Images::where('product_id',$product->id)->delete();
        for ($i=1;$i<=5;$i++){
            if($request->input('images-'.$i)!=null){
                $product->imagess()->create([
                    'image'=>$request->input('images-'.$i),
                    'product_id'=>$product->id
                ]);
            }
        }
        Session::flash('success','Cập nhật thông tin sản phẩm thành công ');
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
            DB::table('product_receipt')
                ->where('product_id','=',$id)
                ->delete();
            Images::where('product_id',$product->id)->delete();
            return Product::where('id',$id)->delete();
        }
        return false;
    }

    public function countReciept()
    {
        return DB::table('product')
            ->select('category.parent_id',DB::raw('if(sum(quantily) is null,0,sum(quantily)) as count'))
            ->leftJoin('product_receipt','product.id','=','product_receipt.product_id')
            ->join('category','category.id','=','product.category_id')
            ->groupBy('category.parent_id')
            ->get();
    }

    public function countBill()
    {
        $pb=DB::table('product_bill')
                ->join('bill','bill.id','=','product_bill.bill_id')
                ->where('bill.bill_type','=','bill')
                ->select('product_bill.*');
        return DB::table('product')
            ->join('category','category.id','=','product.category_id')
            ->leftJoinSub($pb,'pb','pb.product_id','=','product.id')
            ->groupBy('category.parent_id')
            ->select('category.parent_id',DB::raw('if(sum(quantily) is null,0,sum(quantily)) as count'))
            ->get();
    }

    public function findCategoryName()
    {
        return Category::where('category.parent_id', null)->get();
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

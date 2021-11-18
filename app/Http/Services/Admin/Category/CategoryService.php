<?php

namespace App\Http\Services\Admin\Category;

use App\Http\Requests\Menu\CreateFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class CategoryService{

    public function create($request){
        try{
            Category::create([
                'categoryname'=>(string) $request->input('categoryname'),
                'parent_id'=>(int) $request->input('parent_id'),
                'categorycode'=>Str::slug($request->input('categoryname'),''),
                'status'=>(string) $request->input('status')
            ]);
            $request->session()->flash('success', 'Tạo danh mục thành công');
        }catch(\Exception $err){
            $request->session()->flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function findParent($id){
        return Category::where('parent_id',$id)->get();
    }

    public function findAll(){
        return Category::orderby('id','asc')->get();
    }

    public function delete($request){
        $id=(int)$request->input('id');
        $rs=Category::where('id',$id)->first();
        if($rs){
            Product::where('category_id',$id)->delete();
            return Category::where('id',$id)->orWhere('parent_id',$id)->delete();
        }
        return false;
    }

    public function edit($category,$request){
        $category->fill($request->input());
        $category->categorycode=Str::slug($request->input('categoryname'),'-');
        $category->save();
        $request->session()->flash('success', 'Cập nhật thành công!');
        return true;
    }

    public function findByCode($code)
    {
        return Category::where('categorycode',$code)->first();
    }
}

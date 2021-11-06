<?php

namespace App\Http\Services\Client\CategoryClient;

use App\Models\Category;

class CategoryServiceClient
{
    public function findAll(){
        return Category::all();
    }

    public function findOneByCategoryCode($cateCode){
        return Category::where('categorycode',$cateCode)->first();
    }

    /* list ra các loạ sản phẩm con */
    public function findAllChild($id){
        return Category::where('parent_id',$id)->get();
    }

    public function findOneById($id){
        return Category::where('id',$id)->first();
    }


}

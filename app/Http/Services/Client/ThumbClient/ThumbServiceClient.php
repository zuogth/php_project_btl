<?php

namespace App\Http\Services\Client\ThumbClient;

use Illuminate\Support\Facades\DB;

class ThumbServiceClient
{
    public function findAllImgByProductId($id){
        return DB::table('images')
            ->select('images.*')
            ->where('product_id','=',$id)->get();
    }
}

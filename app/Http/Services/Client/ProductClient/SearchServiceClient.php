<?php

namespace App\Http\Services\Client\ProductClient;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchServiceClient
{
    public function findAllByProductName($request){
        $name= Str::of($request->name)->replace(' ','');

       return DB::table('product')
            ->select('*')
            ->selectRaw('REPLACE(product.productname," ","") as name')
            ->whereRaw('REPLACE(product.productname," ","") like "%'.$name.'%"');
    }

}

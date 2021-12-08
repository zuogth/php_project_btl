<?php

namespace App\Http\Services\Client\ProductClient;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SearchServiceClient
{
    public function findAllByProductName($request){
        $name= Str::of($request->name)->replace(' ','');

        $main=self::mainGetCount();

       return DB::table('product')
           ->joinSub($main,'main','main.id','=','product.id')
            ->select('*','main.count')
            ->selectRaw('REPLACE(product.productname," ","") as name')
            ->whereRaw('REPLACE(product.productname," ","") like "%'.$name.'%"');
    }

    private function mainGetCount(){
        $pb=DB::table('product_bill')
            ->join('bill','bill.id','=','product_bill.bill_id')
            ->where('bill.bill_type','=','bill')
            ->select('product_bill.*');
        $receipt=DB::table('product')
            ->select('product.id',DB::raw('sum(product_receipt.quantily) as count'))
            ->leftJoin('product_receipt','product_receipt.product_id','=','product.id')
            ->groupBy('product.id');

        return DB::table('product')
            ->select('product.id',
                DB::raw('if(receipt.count is null,0,receipt.count)-if(sum(pb.quantily) is null,0,sum(pb.quantily)) as count'))
            ->leftJoinSub($pb,'pb','product.id','=','pb.product_id')
            ->joinSub($receipt,'receipt','receipt.id','=','product.id')
            ->groupBy('product.id');
    }
}

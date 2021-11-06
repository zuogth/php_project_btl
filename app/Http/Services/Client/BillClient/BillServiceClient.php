<?php

namespace App\Http\Services\Client\BillClient;

use Illuminate\Support\Facades\DB;

class BillServiceClient
{
    public function findQuantityByProductId($id){
        return DB::table('product_bill')
            ->select('product_id')
            ->selectRaw('sum(quantily) as count_bill')
            ->groupBy('product_id')
            ->having('product_id',$id)->first();
    }

    public function findQuantitReceiptByProductId($id){
        return DB::table('product_receipt')
            ->select('product_id')
            ->selectRaw('sum(quantily) as count_receipt')
            ->groupBy('product_id')
            ->having('product_id',$id)->first();
    }
}

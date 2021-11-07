<?php

namespace App\Http\Services\Client\BillClient;

use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BillServiceClient
{

    public function findCartByIdUser($id)
    {
        return Bill::with('products')->where('user_id',$id)->where('bill_type','cart')->first();
    }

    public function findById($id)
    {
        return Bill::with('products')->where('id',$id)->where('bill_type','cart')->first();
    }

    public function updateBill($bill)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $bill->bill_date= date("Y-m-d H:i:s");
        $bill->bill_type='bill';
        $bill->save();
        Session::flash('success','Bạn đã đặt hàng thành công!');
        return true;
    }

    public function updateCart($request)
    {
        try{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $bill = Bill::where('id', $request->input('bill_id'))->first();
            $bill->totalprice = $request->input('totalprice');
            $bill->bill_date = date("Y-m-d H:i:s");
            $bill->save();
            $product_bill=DB::table('product_bill')
                ->where('bill_id', $request->input('bill_id'))
                ->get();
            foreach ($request->input('id') as $key => $product_id){
                if ($key+1>$product_bill->count()){
                    $bill->products()->attach([
                        $product_id=>['quantily'=>$request->input('count')[$key]]
                    ]);
                }else{
                    DB::table('product_bill')
                        ->where('bill_id', $request->input('bill_id'))
                        ->where('product_id',$product_id)
                        ->update(['quantily'=>$request->input('count')[$key]]);
                }
            }
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function addCart($user_id,$product)
    {
        $bill=Bill::with('products')
                    ->where('user_id',$user_id)
                    ->where('bill_type','cart')
                    ->first();
        if($bill!=null)
        {
            $prod_bill=DB::table('product_bill')
                            ->where('bill_id',$bill->id)
                            ->where('product_id',$product->id)
                            ->first();
            if($prod_bill!=null)
            {
                $quantily=$prod_bill->quantily+1;
                DB::table('product_bill')
                    ->where('bill_id',$bill->id)
                    ->where('product_id',$product->id)
                    ->update(['quantily'=>$quantily]);
            }else{
                $bill->products()->attach([
                    $product->id=>['quantily'=>1]
                ]);
            }
            $totalprice=$bill->totalprice+$product->pricesell*(1-$product->discount/100);
            $bill->update(['totalprice'=>$totalprice]);
        }else{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $billNew=Bill::create([
               'user_id'=>$user_id,
                'bill_date'=>date("Y-m-d H:i:s"),
                'totalprice'=>$product->pricesell*(1-$product->discount/100),
                'status'=>0,
                'bill_type'=>'cart'
            ]);
            $billNew->products()->attach([
                $product->id=>['quantily'=>1]
            ]);
        }
        return true;
    }

    public function delete($product,$bill_id)
    {
        try{
            $bill=Bill::with('products')->where('id',$bill_id)->first();
            $bill->products()->detach($product->id);
            $bill=Bill::with('products')->where('id',$bill_id)->first();
            if($bill->products->count()==0){
                $bill->delete();
            }else{
                $total=0;
                foreach ($bill->products as $item){
                    $total+=$item->pricesell*(1-$item->discount/100)*$item->pivot->quantily;
                }
                $bill->totalprice=$total;
                $bill->save();
            }

        }catch (\Exception $err){
            return $err->getMessage();
        }
        return true;
    }

    public function deleteBill($bill_id){
        DB::table('product_bill')
            ->where('bill_id',$bill_id)
            ->delete();
        Bill::where('id',$bill_id)->delete();
        return true;
    }

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

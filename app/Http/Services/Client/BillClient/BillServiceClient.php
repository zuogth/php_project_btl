<?php

namespace App\Http\Services\Client\BillClient;

use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;

class BillServiceClient
{

    public function findCartByIdUser($id)
    {
        return Bill::with('products')
            ->where('user_id',$id)
            ->where('bill_type','cart')
            ->first();
    }

    public function findByIdUser($id)
    {
        return Bill::with('products')->where('user_id',$id)
            ->where('bill_type','bill')
            ->orderBy('bill_date')
            ->get();
    }

    public function findById($id)
    {
        return Bill::with('products')->where('id',$id)->where('bill_type','cart')->first();
    }

    public function updateBill($bill,$request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $bill->bill_date= date("Y-m-d H:i:s");
        $bill->bill_type='bill';
        $bill->totalprice=$request->totalprice;
        $bill->save();
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
            DB::table('product_bill')
                ->where('bill_id', $request->input('bill_id'))
                ->where('product_id',$request->id)
                ->update(['quantily'=>$request->count]);
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function updateCartFromLocal($user_id,$list_cart,$totalpirce){
        try{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $bill=Bill::where('user_id',$user_id)->where('bill_type','cart')->first();
            if(!$bill){
                Bill::create([
                    'user_id'=>$user_id,
                    'bill_date'=>date("Y-m-d H:i:s"),
                    'totalprice'=>$totalpirce,
                    'status'=>0,
                    'bill_type'=>'cart'
                ]);
                $newBill=Bill::with('products')->where('user_id',$user_id)
                                ->where('bill_type','cart')->first();
                foreach ($list_cart as $item){
                    $newBill->products()->attach([
                        $item['product']->id=>[
                            'quantily'=>$item['quantily'],
                            'price'=>$item['product']->pricesell*(1-$item['product']->discount/100)
                        ]
                    ]);
                }
            }else{
                $totalpirceNew=0;
                $oldBill=Bill::with('products')->where('user_id',$user_id)
                                ->where('bill_type','cart')->first();
                $product_bill=DB::table('product_bill')
                    ->where('bill_id', $oldBill->bill_id)
                    ->get();
                if(!$product_bill){
                    foreach ($list_cart as $item){
                        $oldBill->products()->attach([
                            $item['product']->id=>[
                                'quantily'=>$item['quantily'],
                                'price'=>$item['product']->pricesell*(1-$item['product']->discount/100)
                            ]
                        ]);
                        $totalpirceNew+=$item['product']->pricesell*(1-$item['product']->discount/100)*$item['quantily'];
                    }
                }else{
                    foreach ($list_cart as $item){
                        $prod_bill=DB::table('product_bill')->where('bill_id',$oldBill->id)
                                        ->where('product_id',$item['product']->id)
                                        ->first();
                        if($prod_bill){
                            DB::table('product_bill')->where('bill_id',$oldBill->id)
                                ->where('product_id',$item['product']->id)
                                ->update(['quantily'=>$prod_bill->quantily+$item['quantily']]);
                        }else{
                            $oldBill->products()->attach([
                                $item['product']->id=>[
                                    'quantily'=>$item['quantily'],
                                    'price'=>$item['product']->pricesell*(1-$item['product']->discount/100)
                                ]
                            ]);
                        }
                        $totalpirceNew+=$item['product']->pricesell*(1-$item['product']->discount/100)*$item['quantily'];
                    }
                }
                Bill::with('products')->where('user_id',$user_id)
                    ->where('bill_type','cart')->update(['totalprice'=>$totalpirceNew+$oldBill->totalprice]);
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
                    $product->id=>['quantily'=>1,'price'=>$product->pricesell*(1-$product->discount/100)]
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
                $product->id=>['quantily'=>1,'price'=>$product->pricesell*(1-$product->discount/100)]
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
            ->join('bill','bill.id','=','product_bill.bill_id')
            ->where('bill.bill_type','=','bill')
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

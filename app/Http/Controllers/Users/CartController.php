<?php

namespace App\Http\Controllers\Users;

use App\Http\Services\Client\BillClient\BillServiceClient;
use App\Http\Services\Client\ProductClient\ProductServiceClient;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartController
{
    protected BillServiceClient $billServiceClient;
    protected ProductServiceClient $productServiceClient;
    public function __construct(BillServiceClient $billServiceClient,
                                ProductServiceClient $productServiceClient)
    {
        $this->billServiceClient=$billServiceClient;
        $this->productServiceClient=$productServiceClient;
    }

    public function index(){
        $user=Auth::user();
        $cart=null;
        if($user){
            $cart=$this->billServiceClient->findCartByIdUser($user->id);
        }
        $stars=$this->productServiceClient->starsProduct();
        return view('user.home.cart',[
            'title'=>'Giỏ hàng',
            'cart'=>$cart,
            'stars'=>$stars
        ]);
    }

    public function update(Request $request)
    {
        $bill = $this->billServiceClient->findQuantityByProductId($request->id);
        $billCus=0;
        if($bill==null){
            $billCus=0;
        }else{
            $billCus=$bill->count_bill;
        }
        $receipt = $this->billServiceClient->findQuantitReceiptByProductId($request->id);

        if($request->count>$receipt->count_receipt-$billCus){
            return response()->json([
               'countOut'=>true,
                'count'=>$receipt->count_receipt-$billCus
            ]);
        }
        $rs=$this->billServiceClient->updateCart($request);
        if (!$rs){
            return response()->json([
                'error'=>true
            ]);
        }
        return response()->json([
            'error'=>false
        ]);
    }

    public function addCart(Product $product)
    {
        $user=Auth::user();
        if($user==null){
            return response()->json([
                'error'=>true,
                'count'=>false
            ]);
        }
        $flag=$this->billServiceClient->addCart($user->id,$product);
        if(!$flag){
            return response()->json([
                'error'=>true,
                'count'=>true
            ]);
        }
        return response()->json([
            'error'=>false
        ]);
    }

    public function loadFromLocal(Request $request)
    {
        $list_cart=[];
        $totalprice=0;
        foreach ($request->list_cart as $item){
            $id=$item['product_id'];
            $quantily=$item['quantily'];
            $product=$this->productServiceClient->findById($id);
            $data['product']=$product;
            $data['quantily']=$quantily;
            $totalprice+=$product->pricesell*(1-$product->discount/100)*$quantily;
            $bill = $this->billServiceClient->findQuantityByProductId($id);
            $billCus=0;
            if($bill==null){
                $billCus=0;
            }else{
                $billCus=$bill->count_bill;
            }
            $receipt = $this->billServiceClient->findQuantitReceiptByProductId($id);
            $data['count']=$receipt->count_receipt-$billCus;
            array_push($list_cart,$data);
        }
        $user=Auth::user();
        if($user){
            return $this->billServiceClient->updateCartFromLocal($user->id,$list_cart,$totalprice);
        }
        return $list_cart;
    }

    public function delete(Product $product,Request $request)
    {
        $rs=$this->billServiceClient->delete($product,$request->bill_id);
        return response()->json([
            'message'=>$rs
        ]);
    }

    public function deleteBill(Request $request)
    {
        $rs=$this->billServiceClient->deleteBill($request->bill_id);
        return response()->json([
            'message'=>$rs
        ]);
    }
}

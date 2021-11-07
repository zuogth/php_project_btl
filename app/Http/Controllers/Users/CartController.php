<?php

namespace App\Http\Controllers\Users;

use App\Http\Services\Client\BillClient\BillServiceClient;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController
{
    protected BillServiceClient $billServiceClient;
    public function __construct(BillServiceClient $billServiceClient)
    {
        $this->billServiceClient=$billServiceClient;
    }

    public function index(){
        $user=Auth::user();
        $cart=null;
        if($user){
            $cart=$this->billServiceClient->findCartByIdUser($user->id);
        }
        return view('user.home.cart',[
            'title'=>'Giỏ hàng',
            'cart'=>$cart
        ]);
    }

    public function update(Request $request)
    {
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
        $user_id=Auth::user()->id;
        $this->billServiceClient->addCart($user_id,$product);
        return true;
    }

    public function delete(Product $product,Request $request)
    {
        $rs=$this->billServiceClient->delete($product,$request->bill_id);
        return response()->json([
            'message'=>$rs
        ]);
    }
}

<?php

namespace App\Http\Services\Receipt;

use App\Models\Receipt;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class ReceiptService
{
    public function findAll()
    {
        return Receipt::with('user')->get();
    }

    public function findById($id)
    {
        return Receipt::with(['user', 'products'])->where('id', $id)->first();
    }

    public function edit($receipt, $request)
    {
        $receipt->status = $request->input('status');
        $receipt->save();
        Session::flash('success', 'Cập nhật thông tin sản phẩm thành công');
        return true;
    }

    public function create($receipt, $request)
    {
        try {
            $receipt->user_id=$request->input('user_id');
            $receipt->receipt_date=date("Y-m-d H:i:s");
            $receipt->totalprice=$request->input('totalprice');
            $receipt->status=$request->input('status');
            $receipt->save();
            for($i=1;$i<=$request->input('count_prod');$i++){
                $id=$request->input('product-'.$i);
                $quantily=$request->input('quantily-'.$i);
                $receipt->products()->attach([
                    $id=>['quantily'=>$quantily]
                ]);
            }
            Session::flash('success','Thêm sản phẩm thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }
}

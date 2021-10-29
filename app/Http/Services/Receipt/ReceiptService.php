<?php

namespace App\Http\Services\Receipt;

use App\Models\Receipt;
use Illuminate\Support\Facades\Session;

class ReceiptService
{
    public function findAll()
    {
        return Receipt::with('user')->paginate(10);
    }

    public function findById($id)
    {
        return Receipt::with(['user','products'])->where('id',$id)->first();
    }

    public function edit($receipt,$request)
    {
        $receipt->status=$request->input('status');
        $receipt->save();
        Session::flash('success','Cập nhật thông tin sản phẩm thành công');
        return true;
    }
}

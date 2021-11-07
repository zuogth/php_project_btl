<?php

namespace App\Http\Services\Admin\Bill;

use App\Models\Bill;
use Illuminate\Support\Facades\Session;

class BillService
{
    public function findAll()
    {
        return Bill::with('user')->where('bill_type','bill')->paginate(10);
    }

    public function findById($id)
    {
        return Bill::with(['user','products'])->where('id',$id)->first();
    }

    public function editStatus($bill,$request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $status=$request->input('status');
        $bill->status=$status;
        if($status==2){
            $bill->deliverytime=date("Y-m-d H:i:s");
        }
        $bill->save();
        Session::flash('success','Cập nhật thông tin sản phẩm thành công');
        return true;
    }
}

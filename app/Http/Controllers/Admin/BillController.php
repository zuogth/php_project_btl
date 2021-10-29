<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Bill\BillService;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    protected BillService $billService;
    public function __construct(BillService $billService)
    {
        $this->billService=$billService;
    }
    public function index()
    {
        return view('admin.bill.list',[
            'title'=>'Đơn hàng bán',
            'bills'=>$this->billService->findAll()
        ]);
    }


    public function show(Bill $bill)
    {
        return view('admin.bill.show',[
            'title'=>'Thông tin đơn bán hàng',
            'bill'=>$this->billService->findById($bill->id)
        ]);
    }

    public function edit(Bill $bill,Request $request)
    {
        $this->billService->editStatus($bill,$request);
        return redirect()->back();
    }

}

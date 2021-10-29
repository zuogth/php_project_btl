<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Receipt\ReceiptService;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    protected ReceiptService $receiptService;
    public function __construct(ReceiptService $receiptService)
    {
        $this->receiptService=$receiptService;
    }

    public function index()
    {
        return view('admin.receipt.list',[
            'title'=>'Đơn hàng nhập',
            'receipts'=>$this->receiptService->findAll()
        ]);
    }

    public function show(Receipt $receipt)
    {
        return view('admin.receipt.show',[
            'title'=>'Thông tin đơn hàng nhập',
            'receipt'=>$this->receiptService->findById($receipt->id)
        ]);
    }

    public function edit(Receipt $receipt,Request $request)
    {
        $this->receiptService->edit($receipt,$request);
        return redirect()->back();
    }
}

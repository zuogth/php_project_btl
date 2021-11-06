<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Product\ProductService;
use App\Http\Services\Admin\Receipt\ReceiptService;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;

class ReceiptController extends Controller
{
    protected ReceiptService $receiptService;
    protected ProductService $productService;
    public function __construct(ReceiptService $receiptService,ProductService $productService)
    {
        $this->receiptService=$receiptService;
        $this->productService=$productService;
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

    public function create()
    {
        return view('admin.receipt.add',[
            'title'=>'Thêm hóa đơn nhập',
            'products'=>$this->productService->findAll()
        ]);
    }

    public function store(Receipt $receipt,Request $request)
    {
        $request->validate([
            'product_selected'=>'required'
        ]);
        $this->receiptService->create($receipt,$request);
        return redirect('admin/receipt/list');
    }

    public function list()
    {
        $result=$this->productService->findAll();
        return response()->json([
            'products'=>$result
        ]);
    }

    public function productSelected(Request $request)
    {
        $result=$this->productService->findById($request->input('ids'));
        return response()->json([
            'products'=>$result
        ]);
    }
}

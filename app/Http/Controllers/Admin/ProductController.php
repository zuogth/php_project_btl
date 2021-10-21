<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected ProductService $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }

    public function index()
    {
        return view('admin.product.list',[
            'title'=>'Danh sách sản phẩm',
            'products'=>$this->productService->findAll()
        ]);
    }


    public function create()
    {
        return view('admin.product.add',[
            'title'=>'Thêm sản phẩm mới',
            'menus' =>$this->productService->findMenu()
        ]);
    }


    public function store(ProductRequest $request)
    {
        $this->productService->create($request);
        return redirect()->back();
    }


    public function show(Product $product)
    {
        return view('admin.product.show',[
            'title'=>$product->productname,
            'categories' =>$this->productService->findMenu(),
            'product'=>$product
        ]);
    }


    public function edit(Product $product,ProductRequest $request)
    {
        $this->productService->edit($product,$request);
        return redirect('admin/product/list');
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {

    }
}

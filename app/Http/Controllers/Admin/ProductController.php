<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Product\ProductService;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Sodium\add;

class ProductController extends Controller
{
    protected ProductService $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }

    public function index(Category $category)
    {
        $products=$this->productService->findByCategory($category->id);
        return view('admin.product.list',[
            'title'=>'Danh sách sản phẩm',
            'products'=>$products,
            'typeproduct'=>$products[0]->parent_id
        ]);
    }


    public function create($code)
    {
        return view('admin.product.add',[
            'title'=>'Thêm sản phẩm mới',
            'categories' =>$this->productService->findMenu($code),
            'brands'=>$this->productService->findBrand(),
            'specialities'=>$this->productService->findSpeciality($code)
        ]);
    }


    public function store($code,Product $product,ProductRequest $request)
    {
        $spec_id=[];
        $this->addArray($code,$request,$spec_id);
        $this->productService->create($spec_id,$product,$request);
        return redirect()->back();
    }


    public function show($code,Product $product)
    {
        return view('admin.product.show',[
            'title'=>$product->productname,
            'categories' =>$this->productService->findMenu($code),
            'brands'=>$this->productService->findBrand(),
            'specialities'=>$this->productService->findSpeciality($code),
            'product_speciality'=>$this->productService->findSpecialityByProduct_id($product->id),
            'count_spec'=>$this->productService->findSpecialityByProduct_id($product->id)->count(),
            'product'=>$product
        ]);
    }


    public function edit($code,Product $product,ProductRequest $request)
    {
        $spec_id=[];
        $this->addArray($code,$request,$spec_id);
        $this->productService->edit($product,$request,$spec_id);
        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request)
    {
        $result=$this->productService->delete($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xóa thành công!'
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }

    protected function addArray($code,$request,&$spec_id)
    {
        $codeSpec=$this->productService->findSpecialityByType($code);
        foreach ($codeSpec as $item)
        {
            $input=$request->input($item->code);
            array_push($spec_id,$input);
        }
    }
}

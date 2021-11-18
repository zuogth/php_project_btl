<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Admin\Category\CategoryService;
use App\Http\Services\Admin\Product\ProductService;
use App\Models\Category;
use App\Models\Images;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Sodium\add;

class ProductController extends Controller
{
    protected ProductService $productService;
    protected CategoryService $categoryService;
    public function __construct(ProductService $productService,CategoryService $categoryService)
    {
        $this->productService=$productService;
        $this->categoryService=$categoryService;
    }

    public function index($code)
    {
        $category=$this->categoryService->findByCode($code);
        $products=$this->productService->findByCategory($category->id);
        return view('admin.product.list',[
            'title'=>'Danh sách sản phẩm',
            'products'=>$products,
            'code'=>$code,
            'catename'=>$category->categoryname
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
        return redirect('admin/product/list/'.$code);
    }


    public function show($code,Product $product)
    {
        return view('admin.product.show',[
            'title'=>$product->productname,
            'categories' =>$this->productService->findMenu($code),
            'brands'=>$this->productService->findBrand(),
            'specialities'=>$this->productService->findSpeciality($code),
            'count_spec'=>$this->productService->findSpecialityByProduct_id($product->id)->count(),
            'product'=>$this->productService->findByImagesSpec($product->id),
            'count_images'=>$this->productService->findByImagesSpec($product->id)->imagess->count()
        ]);
    }


    public function edit($code,Product $product,ProductRequest $request)
    {
        $spec_id=[];
        $this->addArray($code,$request,$spec_id);
        $this->productService->edit($product,$request,$spec_id);
        return redirect('admin/product/list/'.$code);
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

    public function order(Request $request)
    {
        $category=$this->categoryService->findByCode($request->input('code'));
        $products=$this->productService->findByCategory($category->id,$request->input('order'));
        return response()->json([
            'products'=>$products,
            'code'=>$request->input('code'),
            'catename'=>$category->categoryname
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

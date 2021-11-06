<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Client\BrandClient\BrandServiceClient;
use App\Http\Services\Client\CategoryClient\CategoryServiceClient;
use App\Http\Services\Client\ProductClient\ProductServiceClient;
use App\Http\Services\Client\SpecialityClient\SpecialityServiceClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomePageController extends Controller
{
    protected ProductServiceClient $productService;

    protected CategoryServiceClient $categoryServiceClient;


    protected BrandServiceClient $brandServiceClient;

    protected SpecialityServiceClient $specialityServiceClient;

    public function __construct(ProductServiceClient $productService,
                                CategoryServiceClient $categoryServiceClient,
                                BrandServiceClient $brandServiceClient,
                                SpecialityServiceClient $specialityServiceClient)
    {
        $this->productService = $productService;

        $this->categoryServiceClient = $categoryServiceClient;

        $this->brandServiceClient = $brandServiceClient;

        $this->specialityServiceClient = $specialityServiceClient;
    }

    public function index(){
        $productsSale = $this->productService->findProductSale();

        return view('user.home.home',[
            'title'=>'trang chủ',
            'productsSale'=>$productsSale,
            'productBestSell'=>$this->productService->findProductByBestSell()
        ]);
    }

    public function new(Request $request){
        $product = $this->productService->findProductBYValue($request);

        return $product;
    }

    public function searchDetail(Request $request){
        $name= Str::of($request->value)->replace(' ','');

            $product = DB::table('product')
                ->select('*')
                ->selectRaw('REPLACE(product.productname," ","") as name')
                ->whereRaw('REPLACE(product.productname," ","") like "%'.$name.'%"',)
                ->paginate(5)->items();
        return $product;
    }
}

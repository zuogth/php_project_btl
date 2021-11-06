<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Http\Services\Client\BrandClient\BrandServiceClient;
use App\Http\Services\Client\CategoryClient\CategoryServiceClient;
use App\Http\Services\Client\ProductClient\ProductServiceClient;
use App\Http\Services\Client\SpecialityClient\SpecialityServiceClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ProductListController extends Controller
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
    public function index($cate,$type = null){

        $prodcut = $this->productService->findAllByType($cate,$type)->get();

        if (!$prodcut){
          return redirect("/404");
        }
        /*load category name*/
        $cate2 = $this->categoryServiceClient->findOneByCategoryCode($cate);
        if (!$type){
            $typeName = $cate2->categoryname;
            $typeDesciption = $cate2->description;
        } else{
            $cateChild = $this->categoryServiceClient->findOneByCategoryCode($type);
            $typeName = $cate2->categoryname. ' - '. $cateChild->categoryname;
            $typeDesciption = $cateChild->description;
        }
        return view('user.home.list',[
            'title'=>'sản phẩm',
            'products'=>$prodcut,
            'typeName'=> $typeName,
//            test
            'productName'=>  $cate2->categoryname,
            'typeCode'=> $cate,
            'brandCode'=> "",
            'categoryChildCode'=> $type,
            'totalProduct'=>ceil(count($prodcut)/6),
//            test

            'typeDesciption'=> $typeDesciption,
            'categoryChile'=>$this->categoryServiceClient->findAllChild($cate2->id),
            'specialities'=> $this->specialityServiceClient->findAllBySpecialCode($cate),
            'brands' => $this->brandServiceClient->findAll(),
            'bestsell'=> $this->productService->findProductByCateAndBestSell($cate)
        ]);
    }

    public function brand($cate,$brand = null){
        $prodcut = $this->productService->findAllByBrand($cate,$brand)->get();
        if (!$prodcut){
            return redirect("/404");
        }
        $cate2 = $this->categoryServiceClient->findOneByCategoryCode($cate);

        $brandChild = $this->brandServiceClient->findOneByBrandCode($brand);
        $typeName = $cate2->categoryname. ' - '. $brandChild->brandname;

        $typeDesciption = $cate2->description;
        return view('user.home.list',[
            'title'=>'sản phẩm',
            'products'=>$prodcut,
            'typeName'=> $typeName,
            'productName'=>  $cate2->categoryname,
//            test
            'typeCode'=> $cate,
            'brandCode'=> $brand,
            'categoryChildCode'=> "",
            'totalProduct'=>ceil(count($prodcut)/6),
//            test
            'typeDesciption'=> $typeDesciption,
            'categoryChile'=>$this->categoryServiceClient->findAllChild($cate2->id),
            'specialities'=> $this->specialityServiceClient->findAllBySpecialCode($cate),
            'brands' => $this->brandServiceClient->findAll(),
            'bestsell'=> $this->productService->findProductByCateAndBestSell($cate)
        ]);
    }

    public function search(Request $request){
        $page = (($request->page) - 1) * 6;
        $product = $this->productService->findProductByRequest($request);
        return $product ->offset($page)
            ->limit(6)
            ->get();;
    }

    public function total(Request $request){
        $product = ceil(count($this->productService->findProductByRequest($request)->get())/6);
        return $product;
    }
    public function pagination(Request $request){
        $product = $this->productService->pagination($request);
        $totalProduct = ceil(count($this->productService->totalProduct($request))/6);
        return response()->json([
            'totalProduct'=> $totalProduct,
            'product'=> $product,
            'cateName' => $request->categoryCode,
            'type' => $request->typeCode,
            'brand' => $request->brandCode
        ]);
//        return $request;
    }



}

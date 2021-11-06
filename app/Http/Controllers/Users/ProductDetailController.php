<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Client\BillClient\BillServiceClient;
use App\Http\Services\Client\BrandClient\BrandServiceClient;
use App\Http\Services\Client\CategoryClient\CategoryServiceClient;
use App\Http\Services\Client\CommentClient\CommentServiceClient;
use App\Http\Services\Client\ProductClient\ProductServiceClient;
use App\Http\Services\Client\SpecialityClient\SpecialityServiceClient;
use App\Http\Services\Client\ThumbClient\ThumbServiceClient;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    protected ProductServiceClient $productService;

    protected CategoryServiceClient $categoryServiceClient;


    protected BrandServiceClient $brandServiceClient;

    protected SpecialityServiceClient $specialityServiceClient;

    protected CommentServiceClient $commentServiceClient;

    protected ThumbServiceClient $thumbServiceClient;

    protected BillServiceClient $billServiceClient;

    public function __construct(ProductServiceClient $productService,
                                CategoryServiceClient $categoryServiceClient,
                                BrandServiceClient $brandServiceClient,
                                SpecialityServiceClient $specialityServiceClient,
                                CommentServiceClient $commentServiceClient,
                                ThumbServiceClient $thumbServiceClient,
                                BillServiceClient $billServiceClient)
    {
        $this->productService = $productService;

        $this->categoryServiceClient = $categoryServiceClient;

        $this->brandServiceClient = $brandServiceClient;

        $this->specialityServiceClient = $specialityServiceClient;

        $this->commentServiceClient = $commentServiceClient;

        $this->thumbServiceClient = $thumbServiceClient;

        $this->billServiceClient =$billServiceClient;
    }

    public function index($slug){
        $product = Product::where('productcode',$slug)->first();
        $bill = $this->billServiceClient->findQuantityByProductId($product->id);
        $receipt = $this->billServiceClient->findQuantitReceiptByProductId($product->id);
        $categoryChild = $this->categoryServiceClient->findOneById($product->category_id);
        $categoryParent = $this->categoryServiceClient->findOneById($categoryChild->parent_id);




        return view('user.home.detail',[
            'title'=>'detail',
            'product'=>$product,
            'star'=>$this->commentServiceClient->findStarsByProductId($product->id),
            'img'=>$this->thumbServiceClient->findAllImgByProductId($product->id),
            'bill'=>$bill,
            'receipt'=>$receipt,
            'categoryChild'=>$categoryChild,
            'categoryParent'=>$categoryParent,
            'comments'=>ceil($this->commentServiceClient->countComment($product->id)/6)

        ]);
    }

    public function comment(Request $request){
        $comments = $this->commentServiceClient->findAllCommentByProductId($request->product_id,$request->page);
        return $comments;
    }

}

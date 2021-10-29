<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductService;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    protected ProductService $productService;
    protected UserService $userService;
    public function __construct(ProductService $productService,UserService $userService)
    {
        $this->productService=$productService;
        $this->userService=$userService;
    }

    public function index()
    {
        $countR=$this->productService->countReciept();
        $countB=$this->productService->countBill();
        return view('admin.home',[
            'title'=>'Admin',
            'countR'=>$countR,
            'countB'=>$countB,
            'catename'=>$this->productService->findCategoryName(),
            'countUser'=>$this->userService->count()
        ]);
    }
}

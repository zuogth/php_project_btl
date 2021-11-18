<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Main\MainService;
use App\Http\Services\Admin\Product\ProductService;
use App\Http\Services\Admin\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    protected ProductService $productService;
    protected UserService $userService;
    protected MainService $mainService;
    public function __construct(ProductService $productService,
                                UserService $userService,
                                MainService $mainService)
    {
        $this->productService=$productService;
        $this->userService=$userService;
        $this->mainService=$mainService;
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

    public function update(Request $request)
    {
        $table = $request->table;
        $id = $request->id;
        $status = $request->status;
        if($table=='users'){
            $user = $this->userService->findById($id);
            if ($user->usertype == 'QT') {
                Session::flash('error','Bạn không thể sửa tài khoản quản trị!');
                return false;
            }
        }
        Session::flash('success','Cập nhật trạng thái thành công!');
        $this->mainService->update($table, $id, $status);
        return true;
    }
}

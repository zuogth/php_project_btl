<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Services\Client\BillClient\BillServiceClient;
use App\Http\Services\Client\ProductClient\ProductServiceClient;
use App\Http\Services\Client\UserClient\UserClientService;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    protected BillServiceClient $billServiceClient;
    protected UserClientService $userService;
    protected ProductServiceClient $productServiceClient;
    public function __construct(UserClientService $userService,
                                ProductServiceClient $productServiceClient,
                                BillServiceClient $billServiceClient)
    {
        $this->userService=$userService;
        $this->productServiceClient=$productServiceClient;
        $this->billServiceClient=$billServiceClient;
    }

    public function store(UserRequest $request)
    {
        $result=$this->userService->create($request);
        if($result){
            return redirect('/user/login');
        }
        return redirect()->back();
    }

    public function register()
    {
        return view('user.home.register',[
            'title'=>'Đăng ký tài khoản mới'
        ]);
    }
}

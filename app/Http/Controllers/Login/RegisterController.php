<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Services\Admin\User\UserService;
use App\Models\Bill;
use App\Models\Comments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function store(UserRequest $request)
    {

        $result=$this->userService->create($request);
        if($result){
            return redirect('/admin/users/login');
        }
        return redirect()->back();
    }

    public function register()
    {
        $bill=Bill::with('products')->where('id',3)->first();

        dd($bill->products->count());
        return view('admin.users.register',[
            'title'=>'Đăng ký tài khoản mới'
        ]);
    }
}

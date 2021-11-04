<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Services\User\UserService;
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
        return view('admin.users.register',[
            'title'=>'Đăng ký tài khoản mới'
        ]);
    }
}

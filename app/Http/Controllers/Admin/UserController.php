<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function index()
    {
        return view('admin.users.list',[
            'title'=>'Danh sách người dùng',
            'users'=>$this->userService->findAll()
        ]);
    }

    public function show(User $user)
    {
        return view('admin.users.show',[
            'title'=>'Thông tin người dùng: '.$user->fullname,
           'user'=>$user
        ]);
    }

    public function edit(User $user,Request $request)
    {
        $this->userService->edit($user,$request);
        return redirect()->back();
    }

}

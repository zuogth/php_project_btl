<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Services\Client\UserClient\UserClientService;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected UserClientService $userService;
    public function __construct(UserClientService $userService)
    {
        $this->userService=$userService;
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
        DB::table('users_role')->where('user_id',9)->delete();
        return view('user.home.register',[
            'title'=>'Đăng ký tài khoản mới'
        ]);
    }
}

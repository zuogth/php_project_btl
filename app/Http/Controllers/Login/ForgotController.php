<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Services\Client\UserClient\UserClientService;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotController extends Controller
{

    protected UserClientService $userClientService;
    public function __construct(UserClientService $userClientService)
    {
        $this->userClientService=$userClientService;
    }

    public function index()
    {
        return view('user.home.forgot',[
            'title'=>'Quên mật khẩu'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            Session::flash('error','Có lỗi xảy ra, hãy thử lại!');
            return redirect()->back();
        }

        $email = $request->all()['email'];
//        $subscriber = User::create([
//                'email' => $email
//            ]
//        );
//
//        if ($subscriber) {
        $pass=Str::random(6);
        $user=$this->userClientService->findByEmail($email);
        $this->userClientService->changePass($user->id,$pass);
            Mail::to($email)->send(new SendMail($email,$pass));
            Session::flash('success','Hãy kiểm tra email của bạn!');
            return redirect()->back();
//        }
    }
}

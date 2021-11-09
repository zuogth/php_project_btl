<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('admin.users.login',[
            'title'=>'Login'
        ]);
    }

    public function login(){
        return view('user.home.login',[
            'title'=>'Đăng nhập'
        ]);
    }

    public function store(Request $request)
    {
        $credentials=$request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials,$request->input('remember'))){
            $user=Auth::user();
            if($user->status!=0){
                if($user->roles[0]->rolecode=='QL'){
                    return redirect()->route('admin');
                }
                return redirect()->route('home');
            }
            Session::flash('error','Tài khoản đã bị khóa');
            return redirect()->back();
        }
        Session::flash('error','Username or password invalid');
        return redirect()->back();
    }

    public function logout()
    {
        $user = Auth::user();
        if ($user->roles[0]->rolecode == 'QL') {
            Auth::logout();
            return redirect()->route('login');
        }
        Auth::logout();
        return redirect()->route('home');
    }
}

<?php

namespace App\Http\Controllers\Admin\Users;

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

    public function store(Request $request)
    {
        $credentials=$request->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials,$request->input('remember'))){
            $user=Auth::user();
            if($user->roles[0]->rolecode=='admin'){
                return redirect()->route('admin');
            }
            return 'User';
        }
        Session::flash('error','Username or password invalid');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

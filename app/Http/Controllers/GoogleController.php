<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            // Check Users Email If Already There
            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){
                $pass=Str::random(6);
                $saveUser = User::create([
                    'social_id' => $user->getId(),
                    'fullname' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($pass),
                    'usercode'=>Str::slug($user->getName(),'-'),
                    'usertype'=>'KH',
                    'status'=>'1'
                ]);
                $saveUser->roles()->attach(1);
                Mail::to($user->getEmail())->send(new SendMail($user->getEmail(),$pass));
                Session::flash('success','Hãy kiểm tra email của bạn để lấy mật khẩu đăng nhập');
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'social_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }
            Auth::loginUsingId($saveUser->id);

            return redirect()->route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

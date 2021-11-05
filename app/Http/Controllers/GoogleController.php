<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            $is_user = User::where('username', $user->getEmail())->first();
            if(!$is_user){
                $str=Str::slug($user->getName().''.$user->getId(),'');
                $saveUser = User::create([
                    'social_id' => $user->getId(),
                    'fullname' => $user->getName(),
                    'username' => $user->getEmail(),
                    'password' => Hash::make($str),
                    'usercode'=>Str::slug($user->getName(),'-'),
                    'usertype'=>'KH',
                    'status'=>'1'
                ]);
                $saveUser->roles()->attach(1);
            }else{
                $saveUser = User::where('username',  $user->getEmail())->update([
                    'social_id' => $user->getId(),
                ]);
                $saveUser = User::where('username', $user->getEmail())->first();
            }
            Auth::loginUsingId($saveUser->id);

            return redirect()->route('home');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

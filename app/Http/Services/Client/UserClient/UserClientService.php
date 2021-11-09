<?php

namespace App\Http\Services\Client\UserClient;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserClientService
{
    public function update($id,$request)
    {
        $fullname=$request->lastname.' '.$request->firstname;
        $user=User::find($id);
        $user->fullname=$fullname;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->usercode=Str::slug($fullname,'-');
        $user->save();
        return true;
    }

    public function create($request)
    {
        try{
            $user=User::create([
                'fullname'=>(string)$request->input('fullname'),
                'username'=>(string)$request->input('username'),
                'email'=>(string)$request->input('email'),
                'phone'=>(string)$request->input('phone'),
                'password'=>bcrypt((string)$request->input('password')),
                'usercode'=>Str::slug($request->input('fullname'),'-'),
                'usertype'=>'KH',
                'status'=>'1'
            ]);
            $user->roles()->attach(1);
            Session::flash('success','Bạn đăng ký thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }
}

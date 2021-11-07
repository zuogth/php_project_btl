<?php

namespace App\Http\Services\Client\UserClient;

use App\Models\User;
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
}

<?php

namespace App\Http\Services\Admin\User;

use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserService
{

    public function findAll()
    {
        return User::with('roles')->paginate(10);
    }

    public function count()
    {
        return DB::table('users')
                ->select(DB::raw('count(id) as count'))
                ->where('users.usertype','=','KH')
                ->first();
    }

    public function edit($user,$request)
    {
        try {
            $user->status=$request->input('status');
            $user->save();
            Session::flash('success','Thêm sản phẩm thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function findById($id)
    {
        return User::find($id);
    }
}

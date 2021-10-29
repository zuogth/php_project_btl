<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;

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
}

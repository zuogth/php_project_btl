<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserClientController extends Controller
{
    public function index()
    {
       return view('user.home.user',[
            'title'=>'Thông tin cá nhân'
        ]);
    }
}

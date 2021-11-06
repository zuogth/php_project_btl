<?php

namespace App\Http\Controllers\Users;

class CartController
{
    public function index(){
        return view('user.home.cart',[
            'title'=>'cart',
        ]);
    }
}

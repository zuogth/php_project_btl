<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store()
    {
        $bill=Bill::with('products')->where('id',2)->first();
        foreach ($bill->products as $product){
            echo $product->pivot->quantily;
        }
    }
}

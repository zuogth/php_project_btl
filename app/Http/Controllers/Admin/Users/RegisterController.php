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
        $bills=Bill::with('products')->first();
        dd($bills->products[0]->pivot);
    }
}

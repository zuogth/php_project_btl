<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function store()
    {
        DB::table('product_bill')
            ->where('product_id','=',20)
            ->delete();
        DB::table('product_speciality')
            ->where('product_id','=',20)
            ->delete();
        DB::table('product')->where('id','=',20)->detele();

        return 'success';
    }
}

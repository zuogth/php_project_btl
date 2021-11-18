<?php

namespace App\Http\Services\Admin\Main;

use Illuminate\Support\Facades\DB;

class MainService
{
    public function update($table,$id,$status)
    {
        return DB::table($table)->where('id',$id)->update(['status'=>$status]);
    }
}

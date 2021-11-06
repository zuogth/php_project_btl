<?php

namespace App\Http\Services\Client\BrandClient;

use App\Models\Brand;

class BrandServiceClient
{
    public function findOneByBrandCode($brandCode){
        return Brand::where('brandcode',$brandCode)->first();
    }

    public function findAll(){
        return Brand::all();
    }
}

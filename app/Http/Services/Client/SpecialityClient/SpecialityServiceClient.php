<?php

namespace App\Http\Services\Client\SpecialityClient;

use App\Models\Speciality;
use Illuminate\Support\Arr;

class SpecialityServiceClient
{
    public function findAllBySpecialCode($typeProduct){
        $specialities = Speciality::where('typeproduct',$typeProduct)->get();
        $results = array();
        foreach ($specialities as $key => $e){
            $specialities2 = Speciality::where('code',$e->code)->get();

            $results[$e->typename] = $specialities2;
        }

        return $results;
    }
}

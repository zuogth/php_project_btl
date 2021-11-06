<?php

namespace App\Http\Services\Admin\Speciality;

use App\Models\Speciality;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SpecialityService
{
    public function findAll()
    {
        Paginator::useBootstrap();
        return DB::table('speciality')->get();
    }

    public function edit($speciality,$request)
    {
        $speciality->mata=$request->input('mata');
        $speciality->description=$request->input('description');
        $speciality->save();
        $request->session()->flash('success', 'Update thành công!');
        return true;
    }

    public function create($speciality,$request)
    {
        try{
            $speciality->fill($request->input());
            $speciality->code=Str::slug($request->input('typename'),'-');
            $typenumber=DB::table('speciality')
                ->select('typenumber')
                ->where('code',$speciality->code)
                ->orderBy('typenumber','desc')
                ->limit(1)
                ->first();
            if($typenumber!=null){
                $speciality->typenumber=$typenumber->typenumber+1;
            }else{
                $speciality->typenumber=1;
            }
            $speciality->save();
            $request->session()->flash('success', 'Tạo đặc tính thành công');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $id=$request->input('id');
        $speciality=Speciality::where('id',$id)->first();
        if($speciality)
        {
            DB::table('product_speciality')->where('speciality_id',$id)->delete();
            return Speciality::where('id',$id)->delete();
        }
        return false;
    }
}

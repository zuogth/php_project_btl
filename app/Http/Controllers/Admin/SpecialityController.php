<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Speciality\SpecialityRequest;
use App\Http\Services\Admin\Category\CategoryService;
use App\Http\Services\Admin\Speciality\SpecialityService;
use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    protected SpecialityService $specialityService;
    protected CategoryService $categoryService;
    public function __construct(SpecialityService $specialityService,CategoryService $categoryService)
    {
        $this->specialityService=$specialityService;
        $this->categoryService=$categoryService;
    }

    public function index()
    {
        return view('admin.speciality.list',[
            'title'=>'Danh sách các đặc tính',
            'specialities'=>$this->specialityService->findAll()
        ]);
    }

    public function show(Speciality $speciality)
    {
        return view('admin.speciality.show',[
            'title'=>'Sửa thông tin đặc tính',
            'speciality'=>$speciality,
            'catename'=>$this->categoryService->findByCode($speciality->typeproduct)->categoryname
        ]);
    }

    public function edit(Speciality $speciality,Request $request)
    {
        $this->specialityService->edit($speciality,$request);
        return redirect()->back();
    }

    public function create()
    {
        return view('admin.speciality.add',[
            'title'=>'Thêm đặc tính mới'
        ]);
    }

    public function store(Speciality $speciality,SpecialityRequest $request)
    {
        $this->specialityService->create($speciality,$request);
        return redirect('admin/speciality/list');
    }

    public function destroy(Request $request)
    {
        $result=$this->specialityService->delete($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xóa thành công'
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }
}

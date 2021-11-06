<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Admin\Category\CategoryService;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService=$categoryService;
    }
    public function create()
    {
        return view('admin.category.add',[
            'title'=>'Thêm danh mục mới',
            'categories'=>$this->categoryService->findParent(null)
        ]);
    }

    public function store(CreateFormRequest $request){
        $this->categoryService->create($request);
        return redirect()->back();
    }

    public function list(){
        return view('admin.category.list',[
            'title'=>'Danh sách danh mục',
            'categories'=>$this->categoryService->findAll()
        ]);
    }

    public function show(Category $category){
        return view('admin.category.show',[
            'title'=>$category->categoryname,
            'category'=>$category,
            'categories'=>$this->categoryService->findParent(null)
        ]);
    }

    public function edit(Category $category, CreateFormRequest $request){
        $this->categoryService->edit($category,$request);
        return redirect('admin/category/list');
    }

    public function delete(Request $request):JsonResponse{
        $result=$this->categoryService->delete($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xóa thành công!'
            ]);
        }
        return response()->json([
                'error'=>true
            ]);

    }
}

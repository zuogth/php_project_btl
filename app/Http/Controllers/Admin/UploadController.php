<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploadService;
use Illuminate\Http\Request;


class UploadController extends Controller
{
    protected UploadService $uploadService;
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService=$uploadService;
    }

    public function store(Request $request)
    {
        $url=$this->uploadService->store($request);
        if($url){
            return response()->json([
                'error'=>false,
                'url'=>$url
            ]);
        }
        return response()->json([
            'error'=>true
        ]);
    }
}

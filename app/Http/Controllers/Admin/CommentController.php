<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\Comment\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected CommentService $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService=$commentService;
    }

    public function index()
    {
        return view('admin.comment.list',[
            'title'=>'Đánh giá của khách hàng',
            'comments'=>$this->commentService->findAll()
        ]);
    }
}

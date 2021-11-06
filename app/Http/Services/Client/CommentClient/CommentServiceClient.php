<?php

namespace App\Http\Services\Client\CommentClient;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class CommentServiceClient
{
    public function findStarsByProductId($product_id){
        return DB::table('comments')
            ->select('comments.product_id')
            ->selectRaw('count(comments.product_id) as cmt')
            ->selectRaw('ROUND(avg( comments.stars),1) as star')
            ->groupBy('comments.product_id')
            ->having('comments.product_id','=',$product_id)->first();
    }

    public function findAllCommentByProductId($product_id,$page){
        return DB::table('comments')
            ->join('users','users.id','=','comments.user_id')

            ->where('comments.product_id','=',$product_id)
            ->orderBy('cmt_datetime', 'desc')
            ->select('comments.*','users.fullname as name')
            ->offset(  (($page) - 1) * 6)
            ->limit(6)
            ->get();;
    }
    public function countComment($product_id){

        return count(DB::table('comments')
            ->select('comments.*')
            ->having('comments.product_id','=',$product_id)->get());
    }
}

<?php

namespace App\Http\Services\Client\CommentClient;

use App\Models\Comments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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

    public function comment($user_id,$request)
    {
        try{
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            Comments::create([
                'product_id'=>$request->product_id,
                'user_id'=>$user_id,
                'title'=>$request->title,
                'cmt_datetime'=>date("Y-m-d H:i:s"),
                'context'=>$request->content,
                'stars'=>$request->stars
            ]);
            Session::flash('success','Cảm ơn bạn đã đánh giá');
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function findByUserId($user_id)
    {
        return Comments::where('user_id',$user_id)->get();
    }
}

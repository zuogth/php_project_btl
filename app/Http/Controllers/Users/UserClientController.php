<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Client\BillClient\BillServiceClient;
use App\Http\Services\Client\CommentClient\CommentServiceClient;
use App\Http\Services\Client\UserClient\UserClientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserClientController extends Controller
{
    protected UserClientService $userClientService;
    protected BillServiceClient $billServiceClient;
    protected CommentServiceClient $commentServiceClient;
    public function __construct(BillServiceClient $billServiceClient,
                                UserClientService $userClientService,
                                CommentServiceClient $commentServiceClient)
    {
        $this->billServiceClient=$billServiceClient;
        $this->userClientService=$userClientService;
        $this->commentServiceClient=$commentServiceClient;
    }

    public function index($active)
    {
        $user=Auth::user();
        if($user==null){
            return redirect('/user/login');
        }
        $bills=$this->billServiceClient->findByIdUser($user->id);
        $cm=$this->commentServiceClient->findByUserId($user->id);
        $arr=[];
        foreach ($cm as $val){
            array_push($arr,$val->product_id);
        }
       return view('user.home.info',[
            'title'=>$active==1?'Thông tin cá nhân':'Đơn đặt hàng',
           'active'=>$active,
           'user'=>$user,
           'bills'=>$bills,
           'comments'=>$arr
        ]);
    }

    public function check(Request $request){
        $user=Auth::user();
        if($user==null){
            return response()->json(['error'=>true]);
        }
        $pass=$user->password;
        if(Hash::check($request->pass, $pass)){
            return response()->json([
                'check'=>true
            ]);
        }
        return response()->json([
            'check'=>false
        ]);
    }

    public function detail(){
        return view('user.home.edit-user',[
            'title'=>'Chỉnh sửa thông tin',
            'user'=>Auth::user()
        ]);
    }


    public function update(Request $request){
        $user=Auth::user();
        if($user==null){
            return response()->json(['error'=>true]);
        }
        $userDetail=$this->userClientService->findByEmail($user->id,$request->email);
        if($userDetail!=null){
            return response()->json([
                'error'=>true,
                'email'=>false,
                'message'=>'Email đã được sử dụng!'
            ]);
        }
        $this->userClientService->updateDetail($user->id,$request);
        return response()->json(['error'=>false]);
    }

    public function password(Request $request)
    {
        $user=Auth::user();
        if($user==null){
            return redirect('/user/login');
        }
        $pass=$user->password;
        if(Hash::check($request->password_now, $pass)){
            $this->userClientService->changePass($user->id,$request);
        }else{
            Session::flash('password-err','Mật khẩu không chính xác.');
            return redirect()->back();
        }
        Session::flash('success','Đổi mật khẩu thành công, hãy đăng nhập lại!');
        return redirect('/user/login');
    }

    public function comment(Request $request)
    {
        $user=Auth::user();
        if($user==null){
            return redirect('/user/login');
        }
        $this->commentServiceClient->comment($user->id,$request);
        return redirect('/user/detail/2');
    }
}

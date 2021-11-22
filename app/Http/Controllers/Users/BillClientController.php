<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserBillRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Services\Client\BillClient\BillServiceClient;
use App\Http\Services\Client\UserClient\UserClientService;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BillClientController extends Controller
{
    protected BillServiceClient $billServiceClient;
    protected UserClientService $userClientService;
    public function __construct(BillServiceClient $billServiceClient,UserClientService $userClientService)
    {
        $this->billServiceClient=$billServiceClient;
        $this->userClientService=$userClientService;
    }

    public function index(Bill $bill)
    {
        $bill=$this->billServiceClient->findById($bill->id);
        $user=Auth::user();
        if ($bill!=null){
            return view('user.home.bill',[
                'title'=>'Đơn hàng',
                'bill'=>$bill,
                'user'=>$user
            ]);
        }
        return redirect('/user/detail/1');
    }

    public function store(Bill $bill,UserBillRequest $request)
    {
        $this->billServiceClient->updateBill($bill,$request);
        $this->userClientService->updateDetail($bill->user_id,$request);
        Session::flash('success','Bạn đã đặt hàng thành công, kiểm tra đơn hàng trong đơn hàng của bạn!');
        return redirect('/user/detail/1');
    }

    public function check(Request $request)
    {
        $order=[];
        $countArr=sizeof($request->id);
        for($i=0;$i<$countArr;$i++){
            $bill = $this->billServiceClient->findQuantityByProductId($request->id[$i]);
            $billCus=0;
            if($bill==null){
                $billCus=0;
            }else{
                $billCus=$bill->count_bill;
            }
            $receipt = $this->billServiceClient->findQuantitReceiptByProductId($request->id[$i]);
            if($request->count[$i]>$receipt->count_receipt-$billCus){
                $data['id']=$request->id[$i];
                $data['count']=$receipt->count_receipt-$billCus;
                array_push($order,$data);
            }
        }
        if(sizeof($order)>0){
            return response()->json([
                'error'=>true,
                'carts'=>$order
            ]);
        }
        return response()->json([
            'error'=>false
        ]);
    }

    public function cancel(Request $request){

        $this->billServiceClient->deleteBill($request->id);
        return true;
    }
}

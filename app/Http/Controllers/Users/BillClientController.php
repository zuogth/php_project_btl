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
        $this->billServiceClient->updateBill($bill);
        $this->userClientService->update($bill->user_id,$request);
        return redirect()->back();
    }
}

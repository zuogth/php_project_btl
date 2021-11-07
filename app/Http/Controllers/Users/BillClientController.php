<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Client\BillClient\BillServiceClient;
use App\Http\Services\Client\UserClient\UserClientService;
use App\Models\Bill;
use Illuminate\Http\Request;

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
        if ($bill!=null){
            return view('user.home.bill',[
                'title'=>'Đơn hàng',
                'bill'=>$bill
            ]);
        }
        return redirect('/user/detail');
    }

    public function store(Bill $bill,Request $request)
    {
        $this->billServiceClient->updateBill($bill);
        $this->userClientService->update($bill->user_id,$request);
        return redirect()->back();
    }
}

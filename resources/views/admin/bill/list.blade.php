@extends('admin.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <a href="/admin/category/add" class="btn btn-success" style="width: 5%"><i class="fas fa-plus"></i></a>
            <table class="table">
                <thead>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Ngày giao</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th style="width:10%">&nbsp;</th>
                </thead>
                <tbody>
                    @foreach($bills as $bill)
                        <tr>
                            <td>{{$bill->id}}</td>
                            <td>
                                {{$bill->user->fullname}}
                            </td>
                            <td>{{$bill->bill_date}}</td>
                            <td>{{$bill->deliverytime}}</td>
                            <td>{!! \App\Helpers\Helper::price($bill->totalprice) !!}</td>
                            <td>{!! \App\Helpers\Helper::statusBill($bill->status) !!}</td>
                            <td>
                                <a href="/admin/bill/edit/{{$bill->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

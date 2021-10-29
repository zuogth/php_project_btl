@extends('admin.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            @if($typeproduct==1||$typeproduct==2)
                <a href="/admin/product/add/{{$typeproduct==1?'TV':'TL'}}" class="btn btn-success" style="width: 5%"><i class="fas fa-plus"></i></a>
            @else
                <a href="/admin/product/add/{{$typeproduct==3?'ML':'MG'}}" class="btn btn-success" style="width: 5%"><i class="fas fa-plus"></i></a>
            @endif

            <table class="table custom">
                <thead>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá gốc</th>
                    <th>Khuyến mãi</th>
                    <th>Thể loại</th>
                    <th>Hoạt động</th>
                    <th>Ảnh</th>
                    <th style="width:10%">&nbsp;</th>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->productname}}</td>
                            <td>{!! \App\Helpers\Helper::price($product->pricesell) !!}</td>
                            <td>{!! \App\Helpers\Helper::price($product->priceentry) !!}</td>
                            <td>{{$product->categoryname}}</td>
                            <td class="status-cus">{!!\App\Helpers\Helper::status($product->status)!!}</td>
                            <td><img src="{{$product->images}}" style="width: 100px;"></td>
                            <td>
                                @if($typeproduct==1||$typeproduct==2)
                                    <a href="/admin/product/edit/{{$typeproduct==1?'TV/'.$product->id:'TL/'.$product->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @else
                                    <a href="/admin/product/edit/{{$typeproduct==3?'ML/'.$product->id:'MG/'.$product->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                @endif
                                <a href='#' class='btn btn-danger btn-sm' onclick='removeRow({{$product->id}},"/admin/product/delete")'><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$products->links()}}
        </div>
    </div>
@endsection

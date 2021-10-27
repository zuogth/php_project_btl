@extends('admin.main')

@section('content')
    <a href="/admin/product/add" class="btn btn-success" style="width: 5%"><i class="fas fa-plus"></i></a>
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
                    <td>{{$product->category->categoryname}}</td>
                    <td class="status-cus">{!!\App\Helpers\Helper::status($product->status)!!}</td>
                    <td><img src="{{$product->images}}" style="width: 100px;"></td>
                    <td>
                        <a href="/admin/product/edit/{{$product->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <a href='#' class='btn btn-danger btn-sm' onclick='removeRow({{$product->id}},"/admin/product/delete")'><i class='fas fa-trash-alt'></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$products->links()}}
@endsection

@extends('admin.main')

@section('head')
    <script src="/BTL/php_project_btl/public/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <form action="" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="nameuser">Tên khách hàng</label>
                            <input type="text" class="form-control" id="nameuser" value="{{$bill->user->fullname}}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="totalprice">Tổng tiền</label>
                            <input type="text" class="form-control" id="totalprice" value="{!! \App\Helpers\Helper::price($bill->totalprice) !!}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="bill_date">Ngày đặt</label>
                            <input class="form-control" type="text" id="bill_date" value="{{$bill->bill_date}}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="deliverytime">Ngày giao</label>
                            <input class="form-control" type="text" id="deliverytime" value="{{$bill->deliverytime}}" readonly>
                        </div>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="status">Trạng thái</label>
                        <select name="status" class="form-control" {{$bill->status==2?'disabled':''}}>
                            @for($i=0;$i<3;$i++)
                                <option value="{{$i}}" {{$bill->status==$i?'selected':''}}>
                                    {{$i==0?'Chờ xác nhận':($i==1?'Đang giao':'Hoàn tất')}}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="container">
                    <label>Danh sách sản phẩm:</label>
                    <table class="table">
                        <thead>
                        <th>Ảnh</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Số lượng mua</th>
                        </thead>
                        <tbody>
                        @foreach($bill->products as $product)
                            <tr>
                                <td>
                                    <img src="{{$product->images}}" style="width: 80px">
                                </td>
                                <td>{{$product->productname}}</td>
                                <td>{!! \App\Helpers\Helper::price($product->pricesell) !!}</td>
                                <td>{{$product->pivot->quantily}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @csrf
            <!-- /.card-body -->
                <div class="card-footer">
                    <a href="/admin/bill/list" class="btn btn-primary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });

    </script>
@endsection

@extends('admin.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Danh sách <span style="text-transform: lowercase;">{{$catename}}</span></h3>
            </div>
            <a href="/admin/product/add/{{$code}}" class="btn btn-success" style="width: 5%"><i class="fas fa-plus"></i></a>
            <table class="table custom" id="table-data">
                <thead>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá gốc</th>
                    <th>Khuyến mãi</th>
                    <th>Thể loại</th>
                    <th>Số lượng</th>
                    <th>Hoạt động</th>
                    <th>Ảnh</th>
                    <th style="width:10%">&nbsp;</th>
                </thead>
                <tbody id="table-products">
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->productname}}</td>
                            <td>{{$product->pricesell}}</td>
                            <td class="status-cus">{{$product->discount}} %</td>
                            <td>{{$product->categoryname}}</td>
                            <td class="status-cus">{{$product->import-$product->sell}}</td>
                            <td class="status-cus">{!!\App\Helpers\Helper::status('product',$product->status,$product->id)!!}</td>
                            <td><img src="{{$product->images}}" style="width: 100px;"></td>
                            <td>
                                <a href="/admin/product/edit/{{$code}}/{{$product->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                <a href='#' class='btn btn-danger btn-sm' onclick='removeRow({{$product->id}},"/admin/product/delete")'><i class='fas fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#table-data').DataTable({
                "dom": '<"toolbar">frtip',
                "info": false,
                columnDefs: [
                    { orderable: false, targets: [3,4,5,6,7,8] },
                    {
                        targets: 2,
                        render: $.fn.dataTable.render.intlNumber('it-IT', {
                            style: 'currency',
                            currency: 'VND'
                        })
                    }
                ],
                "pageLength": 10
            });
            $("div.toolbar").html();
        } );
    </script>
@endsection

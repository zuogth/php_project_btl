@extends('admin.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <a href="/admin/category/add" class="btn btn-success" style="width: 5%"><i class="fas fa-plus"></i></a>
            <table class="table" id="table-data">
                <thead>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Sản phẩm</th>
                    <th>Ảnh</th>
                    <th>Nội dung</th>
                    <th>Đánh giá</th>
                    <th>Ngày đánh giá</th>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->user->fullname}}</td>
                            <td>{{$comment->product->productname}}</td>
                            <td>
                                <img src="{{$comment->product->images}}" width="80px">
                            </td>
                            <td>{{$comment->context}}</td>
                            <td>{{$comment->stars}}</td>
                            <td>{{$comment->cmt_datetime}}</td>
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
                "ordering": false,
                'info':false
            });
            $("div.toolbar").html();
        } );
    </script>
@endsection

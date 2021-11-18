@extends('admin.main')

@section('content')
    <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
            </div>
            <a href="/admin/receipt/add" class="btn btn-success" style="width: 5%"><i class="fas fa-plus"></i></a>
            <table class="table" id="table-data">
                <thead>
                    <th>ID</th>
                    <th>Người nhập</th>
                    <th>Ngày nhập</th>
                    <th>Tổng tiền</th>
                    <th>Hoạt động</th>
                    <th style="width:10%">&nbsp;</th>
                </thead>
                <tbody>
                    @foreach($receipts as $receipt)
                        <tr>
                            <td>{{$receipt->id}}</td>
                            <td>
                                {{$receipt->user->fullname}}
                            </td>
                            <td>{{$receipt->receipt_date}}</td>
                            <td>{{$receipt->totalprice}}</td>
                            <td>{!! \App\Helpers\Helper::status('receipt',$receipt->status,$receipt->id) !!}</td>
                            <td>
                                <a href="/admin/receipt/edit/{{$receipt->id}}" class="btn btn-primary btn-sm"><i class="fas fa-info"></i></a>
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
                    { orderable: false, targets: [4,5] },
                    {
                        targets: 3,
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
